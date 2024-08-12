<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Products;
use App\Models\Images;

class ProductController extends Controller
{

    public function postProducts(Request $request){
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'price' => 'required|numeric',
                'images' => 'required|array',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $product = new Products();
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->user_id = $request->user()->id;
            $product->save();

            $imageUrls = [];

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $imageFile) {
                    $imagePath = $imageFile->store('products', 'public');

                    $images = new Images();
                    $images->product_id = $product->id;
                    $images->image_url = $imagePath;
                    $images->save();

                    $imageUrls[] = $imagePath;
                }
            }

            return response()->json([
                'status' => '201',
                'message' => 'Product created successfully!',
                'product' => $product,
                'image_urls' => $imageUrls
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An error occurred while creating product: ' . $e->getMessage()
            ], 400);
        }
    }


    public function getProducts(){
        return 'Get all Products from Product Controller';
    }

    public function getProductById($id){
        return 'Get Products '. $id;
    }
}
