<?php

namespace App\Http\Controllers\Admin;

use App\Banner;
use Illuminate\Http\Request;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests;



class BannersController extends Controller
{
    protected $itens_por_pagina = 10;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resultados = Banner::paginate($this->itens_por_pagina);

        $view = 'admin.banners.index';

        return view($view, [
            'resultados'        => $resultados,
            'action'            => \Request::path() . '/pesquisa',
            'model'             => 'Banner',
            'table'             => 'banners',
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
        $view = 'admin.banners.edit';

        return view($view, [
            'model'             => 'Banner',
            'table'             => 'banners',
            'view'              => $view
        ]);

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

        $permitidos = array("jpg","jpeg","gif","png", "bmp");
//echo 'sssaaa';die;
//return response()->json('Ocorreu um erro.1', 400);
//        $params =  $request->all();
        $file   = $params['file'];


        //Verificando upload pt_br
        if ($request->hasFile('file'))
            $files = $request->file('file');


        if (!empty($files)) {

            $file            = new \stdClass();
            $file->path      = 'uploads/topos/';
            $file->filename  = $files->getClientOriginalName();
            $file->extension = $files->getClientOriginalExtension();
            $file->size      = $files->getSize();
            $file->mime      = $files->getClientMimeType();
            $file->origin    = 'telescope';
            $file->hash      = md5($file->filename . $file->size);


            if(in_array($file->extension,$permitidos)) {

                $tamanho = round($file->size / 1024);

                if($tamanho < 2048) { //se imagem for até 2MB envia
                    try {
                        //Gravando arquivo com hash temporário no diretório
                        $files->move($file->path, $file->hash . '.' . $file->extension);
                    } catch (Exception $exception) {
                        return response()->json($exception, 400);
                    }

                    $params['filename'] = $file->hash . '.' . $file->extension;

                }else{
                    //-- Fazer um redirect dando a mensagem de erro.
                    $type   = 'danger';
                    $msg    = 'A imagem deve possuir no máximo 2 megas de tamanho.';

                    return redirect('/admin/banners')->with('msg', $msg)->with('type', $type);
                }
            }else{
                //-- Fazer um redirect dando a mensagem de erro.
                $type   = 'danger';
                $msg    = 'Tipo de arquivo não permitido.';

                return redirect('/admin/banners')->with('msg', $msg)->with('type', $type);
            }

        }

        $banner_id = Banner::create($params)->id;

        $type   = 'success';
        $msg    = 'Dados salvos com sucesso !';

        return redirect('/admin/banners')->with('msg', $msg)->with('type', $type);

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
        $resultado = Banner::find($id);

        $view = 'admin.banners.edit';

        return view($view, [
            'resultado'         => $resultado,
            'model'             => 'Banner',
            'table'             => 'banners',
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

            $banner = Banner::find($id);

            $params = $request->all();
            
//echo '<pre>';
//print_r($params);die;

            $permitidos = array("jpg","jpeg","gif","png", "bmp");

            //Verificando upload pt_br
            if ($request->hasFile('file'))
                $files = $request->file('file');

            if (!empty($files)) {

                $file            = new \stdClass();
                $file->path      = 'uploads/topos/';
                $file->filename  = $files->getClientOriginalName();
                $file->extension = $files->getClientOriginalExtension();
                $file->size      = $files->getSize();
                $file->mime      = $files->getClientMimeType();
                $file->origin    = 'local';
                $file->hash      = md5($file->filename . $file->size);


                if(in_array($file->extension,$permitidos)) {

                    $tamanho = round($file->size / 1024);

                    if($tamanho < 2048) { //se imagem for até 2MB envia
                        try {
                            //Gravando arquivo com hash temporário no diretório
                            $files->move($file->path, $file->hash . '.' . $file->extension);
                        } catch (Exception $exception) {
                            return response()->json($exception, 400);
                        }

                        $params['filename'] = $file->hash . '.' . $file->extension;

                        $banner->filename   = $params['filename'];


                    }else{
                        //-- Fazer um redirect dando a mensagem de erro.
                        $type   = 'danger';
                        $msg    = 'A imagem deve possuir no máximo 2 megas de tamanho.';

                        return redirect('/admin/banners')->with('msg', $msg)->with('type', $type);
                    }
                }else{
                    //-- Fazer um redirect dando a mensagem de erro.
                    $type   = 'danger';
                    $msg    = 'Tipo de arquivo não permitido.';

                    return redirect('/admin/banners')->with('msg', $msg)->with('type', $type);
                }

            }



            $banner->description  = $request->description;
            $banner->message      = $request->message;
            $banner->button_label = $request->button_label;

            $banner->save();


            return \Redirect::to('/admin/banners')->with('success','Dados salvos com sucesso !');
        }

    }

}
