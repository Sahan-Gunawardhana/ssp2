@extends('layouts.sidebar')
@section('content')
<h2 class="px-2 pb-10 text-4xl font-semibold text-gray-800 pt-14">Edit Product</h2>
<div class="relative flex flex-col w-full h-full px-2 overflow-scroll text-white bg-white rounded-lg shadow-md bg-clip-border">

    <!-- Display success message if the product was updated -->
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Product Name -->
        <div class="form-group">
            <label for="pro_name" class="text-lg font-medium text-gray-700">Product Name</label>
            <input type="text" class="w-full px-4 py-3 mt-2 text-black border rounded-md form-control" id="pro_name" name="pro_name" value="{{ old('pro_name', $product->pro_name) }}" required>
            @error('pro_name')
                <div class="text-sm text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <!-- Product Price -->
        <div class="form-group">
            <label for="pro_price" class="text-lg font-medium text-gray-700">Product Price</label>
            <input type="text" class="w-full px-4 py-3 mt-2 text-black border rounded-md form-control" id="pro_price" name="pro_price" value="{{ old('pro_price', $product->pro_price) }}" required>
            @error('pro_price')
                <div class="text-sm text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <!-- Product Category -->
        <div class="form-group">
            <label for="category" class="text-lg font-medium text-gray-700">Category</label>
            <input type="text" class="w-full px-4 py-3 mt-2 text-black border rounded-md form-control" id="category" name="category" value="{{ old('category', $product->category) }}" required>
            @error('category')
                <div class="text-sm text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <!-- Shelf Life -->
        <div class="form-group">
            <label for="shelf_life" class="text-lg font-medium text-gray-700">Shelf Life</label>
            <input type="number" class="w-full px-4 py-3 mt-2 text-black border rounded-md form-control" id="shelf_life" name="shelf_life" value="{{ old('shelf_life', $product->shelf_life) }}" required min="0">
            @error('shelf_life')
                <div class="text-sm text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <!-- Product Description -->
        <div class="form-group">
            <label for="pro_description" class="text-lg font-medium text-gray-700">Product Description</label>
            <textarea class="w-full px-4 py-3 mt-2 text-black border rounded-md form-control" id="pro_description" name="pro_description" rows="4" required>{{ old('pro_description', $product->pro_description) }}</textarea>
            @error('pro_description')
                <div class="text-sm text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <!-- Product Dimensions -->
        <div class="form-group">
            <label for="pro_width" class="text-lg font-medium text-gray-700">Product Width</label>
            <input type="number" class="w-full px-4 py-3 mt-2 text-black border rounded-md form-control" id="pro_width" name="pro_width" value="{{ old('pro_width', $product->pro_width) }}" required min="0">
            @error('pro_width')
                <div class="text-sm text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="pro_height" class="text-lg font-medium text-gray-700">Product Height</label>
            <input type="number" class="w-full px-4 py-3 mt-2 text-black border rounded-md form-control" id="pro_height" name="pro_height" value="{{ old('pro_height', $product->pro_height) }}" required min="0">
            @error('pro_height')
                <div class="text-sm text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="pro_length" class="text-lg font-medium text-gray-700">Product Length</label>
            <input type="number" class="w-full px-4 py-3 mt-2 text-black border rounded-md form-control" id="pro_length" name="pro_length" value="{{ old('pro_length', $product->pro_length) }}" required min="0">
            @error('pro_length')
                <div class="text-sm text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <!-- Product Image -->
        <div class="form-group">
            <label for="image" class="block text-lg font-medium text-gray-700">Product Image</label>
            <input type="file" class="w-full mt-2 text-black border border-gray-300 rounded-md focus:outline-none" id="image" name="image">
            @error('image')
                <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full px-6 py-3 text-white bg-teal-600 rounded-md hover:bg-teal-700">Update Product</button>
    </form>
</div>
@endsection