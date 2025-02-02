<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Kreait\Laravel\Firebase\Facades\Firebase;

class ProductController extends Controller
{
    private $storage;

    public function __construct()
    {
        $this->storage = Firebase::storage();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(10);
        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    // Validate request data
    $validatedData = $request->validate([
        'pro_name' => 'required|string|max:255',
        'pro_price' => 'required|numeric|min:0',
        'category' => 'required|string|max:255',
        'shelf_life' => 'required|integer|min:0',
        'pro_description' => 'required|string',
        'pro_width' => 'required|numeric|min:0',
        'pro_height' => 'required|numeric|min:0',
        'pro_length' => 'required|numeric|min:0',
        'quantity' => 'nullable|integer|min:0',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // If there's an image, upload it to Firebase Storage and get the URL
    $imageUrl = null;
    if ($request->hasFile('image')) {
        $imageUrl = $this->uploadImageToFirebase($request);
    }

    // Save product details in MySQL
    $product = Product::create([
        'pro_name' => $validatedData['pro_name'],
        'pro_price' => $validatedData['pro_price'],
        'category' => $validatedData['category'],
        'shelf_life' => $validatedData['shelf_life'],
        'pro_description' => $validatedData['pro_description'],
        'pro_width' => $validatedData['pro_width'],
        'pro_height' => $validatedData['pro_height'],
        'pro_length' => $validatedData['pro_length'],
        'quantity' => $validatedData['quantity'] ?? null, // If quantity is not provided, it will be null
        'pro_image_url' => $imageUrl, // Store the image URL if it exists
    ]);

    return response()->json(['message' => 'Product created successfully!', 'data' => $product], 201);
    }

    public function update(Request $request, $id)
    {
    // Find the product by ID
    $product = Product::findOrFail($id);

    // Validate the request data
    $validatedData = $request->validate([
        'pro_name' => 'required|string|max:255',
        'pro_price' => 'required|numeric|min:0',
        'category' => 'required|string|max:255',
        'shelf_life' => 'required|integer|min:0',
        'pro_description' => 'required|string',
        'pro_width' => 'required|numeric|min:0',
        'pro_height' => 'required|numeric|min:0',
        'pro_length' => 'required|numeric|min:0',
        'quantity' => 'nullable|integer|min:0',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // If there's an image, first delete the old image from Firebase Storage
    if ($request->hasFile('image') && $product->pro_image_url) {
        $this->deleteImageFromStorage($product->pro_image_url);
    }

    // If there's a new image, upload it to Firebase Storage and get the URL
    $imageUrl = $product->pro_image_url; // Default to current image URL if not updated
    if ($request->hasFile('image')) {
        $imageUrl = $this->uploadImageToFirebase($request);
    }

    // Update the product with the validated data
    $product->update([
        'pro_name' => $validatedData['pro_name'],
        'pro_price' => $validatedData['pro_price'],
        'category' => $validatedData['category'],
        'shelf_life' => $validatedData['shelf_life'],
        'pro_description' => $validatedData['pro_description'],
        'pro_width' => $validatedData['pro_width'],
        'pro_height' => $validatedData['pro_height'],
        'pro_length' => $validatedData['pro_length'],
        'quantity' => $validatedData['quantity'] ?? null,
        'pro_image_url' => $imageUrl,
    ]);

    return redirect()->route('admin.products')->with('updateSuccess', true);
    }
    private function uploadImageToFirebase(Request $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = Str::random(20) . '.' . $file->getClientOriginalExtension();

            // Upload to Firebase Storage
            $bucket = $this->storage->getBucket();
            $fileStream = fopen($file->getRealPath(), 'r');
            $bucket->upload($fileStream, [
                'name' => 'productimages/' . $fileName,
                'predefinedAcl' => 'publicRead',
            ]);

            return "https://storage.googleapis.com/{$bucket->name()}/productimages/{$fileName}";
        }

        return null;
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     */
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        // Delete image from Firebase Storage if exists
        if ($product->pro_image_url) {
            $this->deleteImageFromStorage($product->pro_image_url);
        }

        $product->delete();

        return response()->json(['success' => true, 'message' => 'Product deleted successfully!']);
    }

    private function deleteImageFromStorage($imageUrl)
    {
        $bucket = $this->storage->getBucket();

        // Extract the file name from the Firebase URL
        $parsedUrl = parse_url($imageUrl);
        $pathParts = explode('/', $parsedUrl['path']);
        $fileName = end($pathParts); // Get the last part of the URL

        // Ensure the correct folder path
        $object = $bucket->object('productimages/' . $fileName);

        if ($object->exists()) {
            $object->delete();
        }
    }

    public function edit($id)
{
    // Retrieve the product by ID
    $product = Product::findOrFail($id);

    return view('admin.edit-product', compact('product'));
}
}
