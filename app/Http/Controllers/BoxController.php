<?php

namespace App\Http\Controllers;

use App\Http\Resources\BoxResource;
use App\Models\Box;
use Illuminate\Http\Request;

class BoxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $boxes = Box::with(['boxItems', 'customer'])->paginate(10);
        return BoxResource::collection($boxes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:users,id',
            'subscription_type' => 'required|string',
            'status' => 'required|boolean',
            'price' => 'required|numeric|min:0',
        ]);

        $box = Box::create($validated);
        return new BoxResource($box);
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
            'customer_id' => 'required|exists:users,id',
            'subscription_type' => 'required|string',
            'status' => 'required|boolean',
            'price' => 'required|numeric|min:0',
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

