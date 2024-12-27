<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderItemResource;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orderItems = OrderItem::with(['order', 'product'])->paginate(10);
        return OrderItemResource::collection($orderItems);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'total' => 'required|numeric|min:0',
            'box_id' => 'nullable|exists:boxes,id',
        ]);
        $orderItem = OrderItem::create($validate);
        return new OrderItemResource($orderItem);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $orderItem = OrderItem::with(['order', 'product'])->findOrFail($id);
        return new OrderItemResource($orderItem);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'total' => 'required|numeric|min:0',
            'box_id' => 'nullable|exists:boxes,id',
        ]);
        $orderItem = OrderItem::findOrFail($id);
        $orderItem->update($validate);
        return new OrderItemResource($orderItem);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $orderItem = OrderItem::findOrFail($id);
        $orderItem->delete();
        return response()->json(['message' => 'Order item deleted successfully']);
    }
}
