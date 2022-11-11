<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Isset_;

class CategoriesController extends Controller
{
    public function insertCategory(Request $request) {
        $request->validate([
            'name' => 'required',
            'description' => 'required',

        ]);
        $category = new Categories();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();
        return response()->json([
            "status" => 1,
            "msg" => "Categoria insertada correctamente!",
        ]);
    }

    public function showCategory(Request $request) {
        $request->validate([
            'id' => 'nullable',
            'name' => 'nullable',
        ]);

        if(empty($request -> id || $request -> name)){
            //$categories = DB::table('categories')->get(); //Mostrar toda la tabla
            $categories = Categories::select('id', 'name', 'description')
                        ->get();
        }else{
            $categories = Categories::select('id', 'name', 'description')
                        ->where('id', '=', $request->id)
                        ->orWhere('name', $request->name)
                        ->get();
        }
        return response()->json([
            "status" => 1,
            "data" => $categories,
        ]);
    }

    public function deleteCategory(Request $request) {
        $request->validate([
            'id' => 'nullable',
            'name' => 'nullable',
        ]);

        DB::table('categories')
            ->where('id', '=', $request->id)
            ->orWhere('name', '=', $request->name)
            ->delete();

        return response()->json([
            "status" => 1,
            "msg" => "Se ha eliminado correctamente la categoria",
        ]);
    }

    public function updateCategory(Request $request) {
        $request->validate([
            'id' => 'required',
            'newName' => 'nullable',
            'newDescription' => 'nullable',
        ]);

        if(isset($request -> newName)){

            DB::table('categories')
            ->where('id', '=', $request->id)
            ->update(array('name' => $request->newName));

        }
        
        if(isset($request -> newDescription)){

            DB::table('categories')
            ->where('id', '=', $request->id)
            ->update(array('description' => $request->newDescription));

        }

        return response()->json([
            "status" => 1,
            "msg" => "Se ha actualizado correctamente la categoria",
        ]);
    }
}
