<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();


        if ($categories->isEmpty()) {
            return response()->json([
                "message" => "Categories is empty"
            ], 200);
        }

        return response()->json($categories, 200);
        /*         return response()->json([
            "message" => "Todo ok chaval"
        ], 200); */
    }


    // public function create()
    // {

    // }

    public function store(Request $request)
    {
        //validamos los datos (esto se suele hacer con un Custom Request):
        $request->validate([
            "description" => "required"
        ]);

        //damos de alta en la DB

        /* $categorie = Category::create($request->all()); */
        //o también podemos hacer:
        $categorie = Category::create([
            "description" => $request->description
        ]);

        //response
        return response()->json([
            "results" => $categorie
        ], 200);
    }


    public function show(string $id)
    {
        $categorie = Category::findOrFail($id);
        return response()->json([
            "results" => $categorie
        ], 200);
    }


    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //validación de datos
        $request->validate([
            "description" => "required"
        ]);

        //buscamos el $id
        $category = Category::find($id);

        //actualizamos
        $category->description = $request->description;
        $category->save();

        return response()->json([
            "results" => $category
        ], 200);
    }


    public function destroy(string $id)
    {
        Category::findOrFail($id)->delete();

        return response()->json([
            "results" => "La categoría fue eliminada correctamente"
        ], 200);

    }
}
