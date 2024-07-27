<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{

    public function index()
    {
        $products = Product::all();

    //ver $products->categories en View
        // return view('welcome', compact('products'));

        if ($products->isEmpty()) {
            return response()->json([
                "message" => "Products is empty"
            ], 200);
        }

        return response()->json($products, 200);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //validación:
        $request->validate([
            "description" => "required|string",
            "stock" => "required|integer|min:0|max:50",
            "category_id" => "required"
        ]);

        $category = Category::findOrFail($request->category_id);

        $product = $category->products()->create([
            'description' => $request->description,
            'stock' => $request->stock
        ]);

        return response()->json([
            "result" => $product
        ], 200);
    }


    public function show(string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                "success" => false,
                "message" => "Producto no encontrado"
            ], 404);
        } else {
            return response()->json([
                "result" => $product
            ], 200);
        }
    }


    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, $product_id)
    {
        //validación:
        $request->validate([
            "description" => "required|string",
            "stock" => "required|integer|min:0|max:50",
            "category_id" => "required"
        ]);

        $category = Category::findOrFail($request->category_id);

        $product = $category->products()->where('id', $product_id)->update([
            "description" => $request->description,
            "stock" => $request->stock
        ]);

        return response()->json([
            "message" => "Update product",
            "result" => $product
        ], 200);
    }


    public function destroy(string $id)
    {
        Product::findOrFail($id)->delete();

        return response()->json([
            "message" => "Producto eliminado",
        ], 200);
    }
}
