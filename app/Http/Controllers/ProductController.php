<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Exception;

class ProductController extends Controller
{
    public function index()
    {
        try {
            $products = Product::all();
            return response()->json(['message' => 'Products fetched successfully', 'data' => $products]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to fetch products.'], 500);
        }
    }

    public function show($id)
    {
        try {
            $product = Product::find($id);
            if ($product) {
                return response()->json(['message' => 'Product details fetched successfully', 'data' => $product]);
            } else {
                return response()->json(['error' => 'Product not found.'], 404);
            }
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to fetch product details.'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'group_id' => 'required',
                'name' => 'required',
                'details' => 'required',
            ]);

            $product = Product::create($validatedData);
            return response()->json(['message' => 'Product created successfully', 'data' => $product], 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to create product.'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->update($request->all());
            return response()->json(['message' => 'Product updated successfully', 'data' => $product], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to update product.'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            Product::findOrFail($id)->delete();
            return response()->json(['message' => 'Product deleted successfully'], 204);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to delete product.'], 500);
        }
    }
}
