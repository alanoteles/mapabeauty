<?php

namespace App\Http\Controllers\Admin;

use App\Service;
use Illuminate\Http\Request;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests;



class ApoioServicesController extends Controller
{
    protected $itens_por_pagina = 10;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resultados = Service::paginate($this->itens_por_pagina);

        $view = 'admin.tabelas-de-apoio.servicos.index';

        return view($view, [
            'resultados'        => $resultados,
            'action'            => \Request::path() . '/pesquisa',
            'model'             => 'Service',
            'table'             => 'services',
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
        return view('admin.tabelas-de-apoio.servicos.edit');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//echo 'aa : ' . $this->created_by;
//        echo '<pre>';
//        print_r($request->all());//die;

        $params = $request->all();
//        $params['created_by'] = $this->created_by;
        $service_id = Service::create($params)->id;
        //$params['id'] = $news_editorial_id;


        return \Redirect::to('/admin/tabelas-de-apoio/services')->with('success','Dados salvos com sucesso !');

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
        $resultado = Service::find($id);

        $view = 'admin.tabelas-de-apoio.servicos.edit';

        return view($view, [
            'resultado'         => $resultado,
            'model'             => 'Service',
            'table'             => 'services',
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


            $service = Service::find($id);

            $service->description  = $request->description;

            $service->save();


            return \Redirect::to('/admin/tabelas-de-apoio/services')->with('success','Dados salvos com sucesso !');
        }

    }

}
