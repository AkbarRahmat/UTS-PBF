<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductControler extends Controller
{
    public function create(Request $request) {

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

    }


}
