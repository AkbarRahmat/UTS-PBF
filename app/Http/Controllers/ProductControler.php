<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProductControler extends Controller
{
    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|numeric',
            'modified_by' => 'required',
            'expired_at' => 'required|date',
            'image' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error Validation',
                'data' => $validator->errors()
            ], 422);
        }

        $payload = $validator->validated();
        Product::create($payload);

        return response()->json([
            'success' => true,
            'message' => 'Product Added'
        ], 200);
    }

    public function read() {
        $products = Product::all();
        return response()->json([
            'success' => true,
            'message' => 'Product List',
            'data' => $products
        ], 200);
    }

    public function readById($id) {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product Not Found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Product Found',
            'data' => $product
        ], 200);
    }

    public function update(Request $request, $id) {
    }

    public function delete($id) {
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product Not Found'
            ], 404);
        }

        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product Deleted'
        ], 200);
    }


}
