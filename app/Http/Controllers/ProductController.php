<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Images;

class ProductController extends Controller
{
    public function postProducts(Request $request){

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        $product = Products::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'user_id' => $request->user()->id, // Get the authenticated user ID
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imageFile) {
                $imagePath = $imageFile->store('products', 'public');

                // Save image record to the database
                Images::create([
                    'product_id' => $product->id,
                    'image_url' => $imagePath,
                ]);
            }
        }

        return response()->json([
            'status' => '201',
            'message' => 'Product created successfully!',
            'product' => $product,
        ], 201);

    }

    public function getProducts(){
        return 'Get all Products from Product Controller';
    }

    public function getProductById($id){
        return 'Get Products '. $id;
    }
}
