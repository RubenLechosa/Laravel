<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    
    public function insertProduct(Request $request) {
        $request->validate([
            'name' => 'required',
            'stock' => 'required',
            'price' => 'required',
            'description' => 'nullable',
            'id_category' => 'required',

        ]);
        $product = new Products();
        $product->name = $request->name;
        $product->stock = $request->stock;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->id_category = $request->id_category;
        $product->save();
        return response()->json([
            "status" => 1,
            "msg" => "¡Producto insertado correctamente!",
        ]);
    }

    public function showProduct(Request $request) {
        $request->validate([
            'id' => 'nullable',
            'name' => 'nullable',
            'stock' => 'nullable',
            'price' => 'nullable',
            'id_category' => 'nullable',

        ]);

        if(empty($request -> id || $request -> name || $request -> stock || $request -> price || $request -> id_category)){
            //$categories = DB::table('products')->get(); //Mostrar toda la tabla
            $products = Products::select('id', 'name', 'stock', 'price', 'description', 'id_category')
                        ->get();
        }else{
            $products = Products::select('id', 'name', 'stock', 'price', 'description', 'id_category')
                        ->where('id', '=', $request->id)
                        ->orWhere('name', $request->name)
                        ->orWhere('stock', $request->stock)
                        ->orWhere('price', $request->price)
                        ->orWhere('id_category', $request->id_category)
                        ->get();
        }
        return response()->json([
            "status" => 1,
            "data" => $products,
        ]);
    }

    public function deleteProduct(Request $request) {
        $request->validate([
            'id' => 'nullable',
            'name' => 'nullable',
            'stock' => 'nullable',
            'price' => 'nullable',
            'id_category' => 'nullable',
        ]);

        DB::table('products')
            ->where('id', '=', $request->id)
            ->orWhere('name', '=', $request->name)
            ->orWhere('stock', $request->stock)
            ->orWhere('price', $request->price)
            ->orWhere('id_category', $request->id_category)
            ->delete();
        
        return response()->json([
            "status" => 1,
            "msg" => "Se ha eliminado correctamente el producto",
        ]);
    }

    public function updateProduct(Request $request) {
        $request->validate([
            'id' => 'required',
            'newName' => 'nullable',
            'newStock' => 'nullable',
            'newPrice' => 'nullable',
            'newDescription' => 'nullable',
            'newId_category' => 'nullable',
        ]);

        if(isset($request -> newName)){

            DB::table('products')
            ->where('id', '=', $request->id)
            ->update(array('name' => $request->newName));

        }

        if(isset($request -> newStock)){

            DB::table('products')
            ->where('id', '=', $request->id)
            ->update(array('stock' => $request->newStock));

        }

        if(isset($request -> newPrice)){

            DB::table('products')
            ->where('id', '=', $request->id)
            ->update(array('price' => $request->newPrice));

        }
        
        if(isset($request -> newDescription)){

            DB::table('products')
            ->where('id', '=', $request->id)
            ->update(array('description' => $request->newDescription));

        }

        if(isset($request -> newId_category)){

            DB::table('products')
            ->where('id', '=', $request->id)
            ->update(array('id_category' => $request->newId_category));

        }

        return response()->json([
            "status" => 1,
            "msg" => "Se ha actualizado correctamente el producto",
        ]);
    }
}
