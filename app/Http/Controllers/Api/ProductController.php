<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;

class ProductController extends Controller
{
    // GET ALL PRODUCTS
    public function index()
    {
        return Product::with('images', 'category')->get();
    }

    // GET SINGLE PRODUCT
    public function show($id)
    {
        return Product::with('images', 'category')->findOrFail($id);
    }

    // CREATE PRODUCT (POST)
    public function store(Request $request)
    {
    $product = Product::create([
        'title' => $request->title,
        'subtitle' => $request->subtitle,
        'price' => $request->price,
        'rating' => $request->rating,
        'category_id' => $request->category_id
    ]);

    // ✅ HANDLE IMAGE FILE UPLOAD
    if ($request->hasFile('images')) {

        foreach ($request->file('images') as $file) {

            $path = $file->store('products', 'public');

            ProductImage::create([
                'product_id' => $product->id,
                'image_url' => asset('storage/' . $path)
            ]);
        }
    }

    return response()->json([
        'message' => 'Product created',
        'data' => $product->load('images', 'category')
    ], 201);
    }

    // UPDATE PRODUCT (PUT)
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->update([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'price' => $request->price,
            'rating' => $request->rating,
            'category_id' => $request->category_id
        ]);

        return response()->json([
            'message' => 'Product updated',
            'data' => $product
        ]);
    }

    // DELETE PRODUCT
    public function destroy($id)
    {
        Product::destroy($id);

        return response()->json([
            'message' => 'Product deleted'
        ]);
    }
}