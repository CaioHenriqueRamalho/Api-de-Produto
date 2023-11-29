<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\apiproducts;
use Illuminate\Http\Request;
use App\Http\Requests\Requestapiproducts;
use Illuminate\Support\Facades\Validator;

class ApiProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $product = ApiProducts::all();
        return response()->json($product);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $valida = Validator::make($request->all(), [
            'name' => 'required|max:150|min:10',
            'value' => 'required',
            'description' => 'max:255|min:10',
            "status" =>'required'
        ]);

        if ($valida->fails()) {
            return response()->json([
                'message' => 'Sua requisição está faltando dados'
            ], 400);
        };


        $product = ApiProducts::create($request->all());

        return response()->json
            ([
                'message'=> 'Produto salvo',
                'product'=> $product
            ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\apiproducts  $apiproducts
     * @return \Illuminate\Http\Response
     */
    public function show(ApiProducts $product)
    {
        return response()->json
           ([
               'message'=> 'Sucesso',
               'product'=> $product
           ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\apiproducts  $apiproducts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ApiProducts $product)
    {
        $valida = Validator::make($request->all(), [
            'name' => 'required|max:150|min:10',
            'value' => 'required',
            'description' => 'max:255|min:10',
        ]);

        if ($valida->fails()) {
            return response()->json([
                'message' => 'Sua requição está faltando dados'
            ], 400);
        }


 
        $product->update($request->all());
        return response()->json
             ([
               'message'=> 'Produto atualizado com sucesso',
               'product' => $product
             ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\apiproducts  $apiproducts
     * @return \Illuminate\Http\Response
     */
    public function destroy(ApiProducts $product)
    {
        $product->delete();

        return response()->json
           ([
               'message'=> 'Produto deletado com sucesso',
           ], 200);

     }
}
