<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;

class productController extends Controller
{
 
    public function store(Request $request) {
        $validator = Validator::make($request->all(),[
            'product_name' => 'required|max:50'
            'product_type'=> 'required|in:snack,drink,fruit,drug,groceries,cigarette,make-up,cigarette',
            'product_price'=> 'required|numeric',
            'expired_at'=> 'required|date'
        ]);

        if($validator->fails()) {

            return response()->json($validator->messages())->setStatusCode(422);
        }

        $payload = $validator->validated();

        Product::create([
            'product_name' => $payload['product_name'],
            'product_type' => $payload['product_type'],
            'product_price'=> $payload['product_price'],
            'expired_at' => $payload['expired_at']
        ]);

        return response()->json([
            'msg' => 'Data produk berhasil disimpan'
        ],201);
        
    }

    function showAll(){
        $products = product::all();

        return reponse()->json([
            'msg' => 'Data produk keseluruhan',
            'data' => $products
        ], 200);
    }
    function showByld(){
    }
    function showByName(){
    }
}
