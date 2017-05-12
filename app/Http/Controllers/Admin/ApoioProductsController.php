<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use Illuminate\Http\Request;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests;



class ApoioProductsController extends Controller
{
    protected $itens_por_pagina = 10;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resultados = Product::paginate($this->itens_por_pagina);

        $view = 'admin.tabelas-de-apoio.produtos.index';

        return view($view, [
            'resultados'        => $resultados,
            'action'            => \Request::path() . '/pesquisa',
            'model'             => 'Product',
            'table'             => 'products',
            'exibir'            => 'S',
            'view'              => $view
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tabelas-de-apoio.produtos.edit');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $params = $request->all();

        $product_id = Product::create($params)->id;


        return \Redirect::to('/admin/tabelas-de-apoio/products')->with('success','Dados salvos com sucesso !');

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $resultado = Product::find($id);

        $view = 'admin.tabelas-de-apoio.produtos.edit';

        return view($view, [
            'resultado'         => $resultado,
            'model'             => 'Product',
            'table'             => 'products',
            'view'              => $view
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->ajax()){
            parent::update($request, $id);
        }else {


            $product = Product::find($id);

            $product->description  = $request->description;

            $product->save();


            return \Redirect::to('/admin/tabelas-de-apoio/products')->with('success','Dados salvos com sucesso !');
        }

    }

}
