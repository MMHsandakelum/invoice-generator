<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
   public function get_all_products(){
        $products = Product::orderBy('id', 'DESC')->get(); 
        return response()->json([
            'products' => $products
        ]);
   }

   public function add_new_product(){
    $product = Product::orderBy('id', 'DESC')->first();

    $formData = [
        "item_code" => "IS-000" . $product->id + 1,
        "name" => null,
        "description" => null,
        "unit_price" => 0,
        "stoke_count" => 1
    ];

    return response()->json([
        "formData" => $formData
    ], 200);
   }

   public function add_product(Request $request){

        $formData["item_code"] = $request->item_code;
        $formData["name"] = $request->name;
        $formData["description"] = $request->description;
        $formData["unit_price"] = $request->unit_price;
        $formData["stoke_count"] = $request->stoke_count; 
        
        Product::create($formData);
        return response()->json(["message" => "successfully added"], 200);
   }
}
