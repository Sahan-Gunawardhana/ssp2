<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with(['orderItems.product', 'customer'])->paginate(10);
        return OrderResource::collection($orders);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'customer_id' => 'required|exists:users,id',
        'order_date' => 'nullable|date',
        'zip_code' => 'required|string|max:10',
        'province' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'street' => 'required|string|max:255',
        'total' => 'required|numeric|min:0',
        'status' => 'required|string|in:pending,processing,completed,cancelled',
        'items' => 'required|array',
        'items.*.product_id' => 'required|exists:products,id',
        'items.*.quantity' => 'required|integer|min:1',
        'items.*.total' => 'required|numeric|min:0',
        'items.*.box_id' => 'nullable|exists:boxes,id',
    ]);

    try {
        DB::beginTransaction(); // Start transaction

        $order = Order::create([
            'customer_id' => $validated['customer_id'],
            'order_date' => $validated['order_date'] ?? now(),
            'zip_code' => $validated['zip_code'],
            'province' => $validated['province'],
            'city' => $validated['city'],
            'street' => $validated['street'],
            'total' => $validated['total'],
            'status' => $validated['status']
        ]);
        foreach ($validated['items'] as $item) {
            OrderItem::create([
                'order_id' => $order->id, // Attach the new order_id
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'total' => $item['total'],
                'box_id' => $item['box_id'] ?? null
            ]);
        }

        DB::commit(); // Commit transaction

        return response()->json([
            'message' => 'Order and items saved successfully!',
            'order' => new OrderResource($order)
        ], 201);
    } catch (\Exception $e) {
        DB::rollBack(); // Rollback if something goes wrong
        return response()->json(['error' => 'Order creation failed!', 'details' => $e->getMessage()], 500);
    }
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::with(['orderItems', 'customer'])->findOrFail($id);
        return new OrderResource($order);
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
        'status' => 'required|string|in:pending,confirmed,shipped,canceled'
        ]);

        $order = Order::findOrFail($id);
        $order->update($validated);
        return new OrderResource($order);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return response()->json(['message' => 'Order deleted successfully'], 200);
    }
}
