<?php

namespace App\Http\Controllers;

use App\Gallery;
use App\Payer;
use App\Products;
use App\Profile;
use App\Purchase;
use App\User;
use App\Service;
use App\State;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
                    'products'  => Product::get(),
                    'services'  => Service::get()

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

        $user = User::create(array(
            'name'  => $params['responsible_name'],
            'email' => $params['responsible_email'],
        ));
        $gallery    = json_decode($params['uploads'], true);

        $profile = Profile::create($params);

        foreach($gallery as $img){

            $img['filename'] = $img['hash'] . '.' . $img['extension'];
            Gallery::create($img);
        }


//        foreach($gallery as $img){
//
//            $img['filename'] = $img['hash'] . '.' . $img['extension'];
//            Gallery::create($img);
//        }

        $services   = json_decode($params['services'], true);
        echo '<pre>';
        print_r($gallery);
        print_r($services);
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

        $user = User::join('profiles', 'profiles.user_id', '=', 'users.id')
                    ->where('users.id', $id)->get();

        if(count($user)){

            //-- Check if the user have a valid purchase and how many days left
            $purchases = Purchase::where('user_id', $id)->orderBy('created_at')->take(1)->get();

            if(count($purchases)){
//echo '<pre>';
//print_r($purchases);die;
                $created            = new Carbon($purchases[0]['transaction_date']);
                $now                = Carbon::now();

                $product_total_days = Product::find($purchases[0]['product_id'])->days;
                $remaining_days     = $product_total_days - $created->diff($now)->days;

            }

            //-- Value to be paid if user wants to be detached
            $detached_value = number_format(Product::where('status', 'D')->value('value'),2,',','.');

//echo $detached_value;die;
//echo '<pre>';
//print_r($user);die;

            return view('layouts.profile', [
                'page' => '1',
                'cities'            => City::get(),
                'states'            => State::get(),
                'products'          => Product::where('status', '1')->get(),
                'services'          => Service::where('status', '1')->get(),
                'payers'            => Payer::where('status', '1')->get(),
                'user'              => $user[0],
                'detached_value'    => $detached_value,
                'purchase'          => ( !empty($purchases) ? $purchases[0] : ''),
                'remaining_days'    => $remaining_days

            ]);
        }else{
            return redirect('login');
        }

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
//echo '<pre>';
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
            $file->subtitle  = $params['file_subtitle'];

            if(!empty($params['logo'])){
                $file->logo    = '1';
            }else{
                $file->logo    = '0';
            }

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
