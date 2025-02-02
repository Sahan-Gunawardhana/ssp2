<?php

namespace App\Http\Controllers;

use App\Http\Resources\BoxResource;
use App\Models\Box;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BoxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $boxes = Box::with(['boxItems.product', 'customer'])->paginate(10);
        return BoxResource::collection($boxes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'customer_id' => 'required|exists:users,id',
        'subscription_type' => 'required|string|in:weekly,monthly',
        'status' => 'required|integer|in:0,1',
        'zip_code' => 'required|string|max:10',
        'province' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'street' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'items' => 'required|array',
        'items.*.product_id' => 'required|exists:products,id',
        'items.*.quantity' => 'required|integer|min:1',
        'items.*.total' => 'required|numeric|min:0',
    ]);

    try {
        DB::beginTransaction(); // Start transaction

        // Create the new box
        $box = Box::create([
            'customer_id' => $validated['customer_id'],
            'subscription_type' => $validated['subscription_type'],
            'status' => $validated['status'],
            'zip_code' => $validated['zip_code'],
            'province' => $validated['province'],
            'city' => $validated['city'],
            'street' => $validated['street'],
            'price' => $validated['price']
        ]);

        // Create the box items associated with the box
        foreach ($validated['items'] as $item) {
            OrderItem::create([
                'box_id' => $box->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'total' => $item['total'],
                'order_id' => $item['order_id'] ??  null
            ]);
        }

        DB::commit(); // Commit transaction

        return response()->json([
            'message' => 'Box and items saved successfully!',
            'box' => new BoxResource($box)
        ], 201);
    } catch (\Exception $e) {
        DB::rollBack(); // Rollback if something goes wrong
        return response()->json(['error' => 'Box creation failed!', 'details' => $e->getMessage()], 500);
    }
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $box = Box::with(['boxItems', 'customer'])->findOrFail($id);
        return new BoxResource($box);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'status' => 'required|boolean',
        ]);
        $box = Box::findOrFail($id);
        $box->update($validated);
        return new BoxResource($box);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $box = Box::findOrFail($id);
        $box->delete();
        return response()->json(['message' => 'Box deleted successfully']);
    }
}

