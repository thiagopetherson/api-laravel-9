<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Http\Requests\Store\StoreStoreRequest; // Form Request
use App\Http\Requests\Store\StoreUpdateRequest; // Form Request
use Symfony\Component\HttpFoundation\Response;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = Store::all();
        return response()->json($stores, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStoreRequest $request)
    {
       $store = new Store;
       $store->name = $request->name;
       $store->email = $request->email;
       $store->save();

       return response()->json($store, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $store = Store::with('products')->where('id',$id)->first();
        $store = Store::find($id);

        if($store === null) {
            return response()->json(['erro' => 'Loja pesquisada não existe'], 404);
        }

        return response()->json($store, 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateRequest $request, $id)
    {
        $store = Store::find($id);

        if($store) {
            $store->name = $request->name;
            $store->email = $request->email;
            $store->save();
            return response()->json($store, 200);
        }

        return response()->json(['erro' => 'Loja não existe'], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $store = Store::find($id);

        if($store) {
            $store->delete();
            return response()->json(['Mensagem:' => 'A loja e seus produtos foram excluídos com sucesso!'], Response::HTTP_NO_CONTENT);
        }

        return response()->json(['erro' => 'Impossível realizar a exclusão. A loja não existe'], 404);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexWithProducts()
    {
        $stores = Store::with('products')->get();
        return response()->json($stores, 200);
    }

    public function showWithProducts($id)
    {
        $store = Store::with('products')->where('id',$id)->first();

        if($store === null) {
            return response()->json(['erro' => 'Loja pesquisada não existe'], 404);
        }

        return response()->json($store, 200);
    }
}
