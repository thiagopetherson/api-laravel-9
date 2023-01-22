<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Models\Product;
use App\Models\Store;
use App\Http\Requests\Product\ProductStoreRequest; // Form Request
use App\Http\Requests\Product\ProductUpdateRequest; // Form Request
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::get();
        return response()->json($product, 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        $dataForm = $request->only('store_id','name','value', 'active');
        $product = Product::create($dataForm);

        if ($product) {
            // Pegando a coleção da loja associada ao produto (através do relacionamento)
            $product = Product::with('store')->find($product->id);

            // Email
            $sendMail = new SendMail($product);
            Mail::to($product->store->email)->send($sendMail);

            return response()->json($product, 200);
        }

        return response()->json(['erro' => 'O produto não foi cadastrado'], 404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        if ($product === null) {
            return response()->json(['erro' => 'O produto pesquisado não existe'], 404);
        }

        return response()->json($product, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, $id)
    {
        $product = Product::find($id);

        if ($product) {
            $dataForm = $request->only('store_id','name','value', 'active');

            if ($product->update($dataForm)) {

                // Pegando a coleção da loja associada ao produto (através do relacionamento)
                $product = $product->with('store')->where('id', $id)->first();

                // Email
                $sendMail = new SendMail($product);
                Mail::to($product->store->email)->send($sendMail);

                return response()->json($product, 200);
            }

            return response()->json(['erro' => 'O produto não foi atualizado'], 404);
        }

        return response()->json(['erro' => 'O produto não existe'], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if($product) {
            $product->delete();
            return response()->json(['Mensagem:' => 'O produto foi excluído com sucesso!'], Response::HTTP_NO_CONTENT);
        }

        return response()->json(['erro' => 'Impossível realizar a exclusão. O produto não existe'], 404);
    }
}
