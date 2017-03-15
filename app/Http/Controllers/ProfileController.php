<?php

namespace App\Http\Controllers;

use App\Products;
use App\State;
use Illuminate\Http\Request;

//use App\Http\Requests;
use App\City;
use App\Product;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $params = $request->all();
        
//        echo '<pre>';
//        print_r($params);die;
        return view('layouts.profile', [
                    'page' => '2',
                    'cities'    => City::get(),
                    'states'    => State::get(),
                    'products'  => Product::get()

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $params = $request->all();

        echo '<pre>';
        //$data = json_decode($params['uploads'], true);
        print_r($params);die;
        echo 'www';die;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function uploadAnexo(Request $request)
    {
        $permitidos = array("jpg","jpeg","gif","png", "bmp");

        $params =  $request->all();
        $file   = $params['file'];
//echo public_path() . '<pre>';
//print_r($params);die;

        //Verificando upload pt_br
        if ($request->hasFile('file'))
            $files = $request->file('file');


        if (!empty($files)) {

            $file            = new \stdClass();
            $file->path      = 'uploads/fotos/';
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

                    return response()->json(array('file_info_uploaded' => $file), 200);
                }else{
                    return response()->json(array('msg' => 'A imagem deve possuir no máximo 2 megas de tamanho.'), 400);
                }
            }else{
                return response()->json('Tipo de arquivo não permitido.', 400);
            }

        }

    }
}
