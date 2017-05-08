<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;
use Mail;
use App\User;
use App\City;
use App\State;
use App\Gallery;
use App\Payer;
use App\Product;
use App\Profile;
use App\Purchase;
use App\Service;
use App\Neighborhood;
use Carbon\Carbon;
use Auth;
use DB;
use Session;
use Psy\Util\Json;
use App\Http\Controllers\Admin\Controller;
use App\Http\Controllers\Controller as ControllerFront;

class ProfileController extends Controller
{

    protected $itens_por_pagina = 50;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::paginate($this->itens_por_pagina);

        $view = 'admin.profiles.index';

        return view($view, [
            'users'             => $users,
            'action'            => \Request::path() . '/pesquisa',
            'model'             => 'User',
            'table'             => 'users',
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
        $detached_value = number_format(Product::where('status', 'D')->value('value'),2,',','.');

//        foreach ($user->profiles->services as $key => $value) {
//            // echo $value->pivot->service_id
//            // $profile_service[] = json_encode(array("id" => $value->pivot->service_id, "price" => $value->pivot->price));
//            $profile_service[] = json_encode(array('id' => $value->pivot->service_id, 'price' => $value->pivot->price));
//        }
//
//        foreach ($user->profiles->galleries as $key => $value) {
//            // echo $value->pivot->service_id
//            // $profile_service[] = json_encode(array("id" => $value->pivot->service_id, "price" => $value->pivot->price));
//            if($value->status == '1'){
//                $file_data = explode('.', $value->filename);
//
//                $gallery_profile[] = json_encode(array( 'hash'      => $file_data[0],
//                    'extension' => $file_data[1],
//                    'subtitle'  => $value->subtitle,
//                    'size'      => $value->size,
//                    'logo'      => $value->logo));
//            }
//        }

//        echo '<pre>';
//        print_r($user);die;

        return view('admin.profiles.edit',[
            'products'          => Product::where('status', '1')->get(),
            'services'          => Service::where('status', '1')->get(),
            'payers'            => Payer::where('status', '1')->get(),
            'detached_value'    => $detached_value,
            'remaining_days'    => '',
            'model'             => 'Profile'

        ]);


    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

//                echo '<pre>';
//        print_r($request->all());die;

        //-- Se na tela de listagem o usuário clicou para mudar o status do registro, o update é chamado via AJAX.
        //-- Caso contrário, o form está sendo atualizado pelo botão SALVAR
//        if($request->ajax()){
//            parent::update($request, $id);
//        }else{

            $params = $request->all();
//echo '<pre>';
//print_r($params);die;
            $senha                  = str_random(6);
            $params['provider']     = 'local';
            $params['password']     = md5($senha);
            $params['provider_id']  = mt_rand();
            $params['email']        = $params['responsible_email'];
            $params['name']         = $params['responsible_name'];

            $user  = User::create($params);

            //$params             = $request->all();
            $params['user_id']  = $user->id;

//            echo '<pre>';print_r($params);die;
            $state  = json_decode($params['state'], true);
            $city   = json_decode($params['city'], true);

            //-- Clean up special chars
            $to_be_removed                   = array(".", ",", "/", "(", ")", "-", " ");
            $params['document']              = str_replace($to_be_removed, '', $params['document']);
            $params['responsible_cellphone'] = str_replace($to_be_removed, '', $params['responsible_cellphone']);
            $params['zip_code']              = str_replace($to_be_removed, '', $params['zip_code']);
            $params['whatsapp']              = str_replace($to_be_removed, '', $params['whatsapp']);
            $params['state']                 = $params['state'];
            $params['city']                  = $params['city'];

            if(!empty($user->profiles)){ //-- Update
                $user->profiles->fill($params)->save();
                $operation = 'update';
            }else{ //-- Create
                $profile  = Profile::create($params);
                $operation = 'create';
            }

            //-- Attach images
            $gallery    = json_decode($params['uploads'], true);
            //$gallery    = json_decode($gallery, true);

        $user = User::find($user->id);
//echo '<pre>';
////        echo $gallery->hash;
//print_r($gallery);//die;
//print_r($user);
//print_r($profile);
//print_r($user2->profiles);die;
            if(count($gallery) > 1){
                foreach($gallery as $img){
                    $img = json_decode($img);
                    $img->filename = $img->hash . '.' . $img->extension;

//                    echo '<pre>';print_r($img);//die;
                    $id_img = Gallery::create((array)$img)->id;

                    $user->profiles->galleries()->attach($id_img);
                }
            }elseif(count($gallery) == 1){ //-- TODO : Terminar essas implementação !!!!
                $gallery    = json_decode($gallery, true);
            }

// echo '<pre>';print_r($params);//die;
            //-- Attach services
            $services   = json_decode($params['services'], true);

            if(count($services) > 1){
                foreach($services as $service){
                    $service        = json_decode($service);
// print_r($service);
                    $service->price = ($service->price == 'Sob consulta') ? 0 : $service->price;
                    $service->price = str_replace('.', '' , $service->price);
                    $service->price = str_replace(',', '.', $service->price);

                    $profile_service[] = ["service_id" => $service->id, "price" => $service->price];
                }
//                $user->profiles->services()->detach();
                $user->profiles->services()->attach($profile_service);
            }elseif(count($services) == 1){
                $service        = json_decode($services);
// print_r($service);
                $service->price = ($service->price == 'Sob consulta') ? 0 : $service->price;
                $service->price = str_replace('.', '' , $service->price);
                $service->price = str_replace(',', '.', $service->price);

                $profile_service[] = ["service_id" => $service->id, "price" => $service->price];

                $user->profiles->services()->attach($profile_service);
            }



            //-- Save purchase just if it is courtesy
            // if(!empty($params['product_id'])){
            $product = explode('#', $params['product_id']);
            if($product[0] = '1'){
                $purchase = array(  'product_id'         => '1',
                    'transaction_id'    => 'free',
                    'transaction_date'  => date('Y-m-d H:m:s'),
                    'payer_id'          => '',
                    'status_id'         => 2,
                    'detached'          => '0',
                    'courtesy'          => '1');

                $user->purchases()->create($purchase);
            }

            //}

            if($operation == 'create'){
                $msg    = 'Seu cadastro foi criado com sucesso ! ';
            }else{
                $msg    = 'Seu cadastro foi atualizado com sucesso ! ';
            }

            $type   = 'success';

die;

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
        $user           = User::find($id);
        $city           = City::find($user->profiles->city);
        $state          = State::where('code', $user->profiles->state)->first();
        $detached_value = number_format(Product::where('status', 'D')->value('value'),2,',','.');

        foreach ($user->profiles->services as $key => $value) {
            // echo $value->pivot->service_id
            // $profile_service[] = json_encode(array("id" => $value->pivot->service_id, "price" => $value->pivot->price));
            $profile_service[] = json_encode(array('id' => $value->pivot->service_id, 'price' => $value->pivot->price));
        }

        foreach ($user->profiles->galleries as $key => $value) {
            // echo $value->pivot->service_id
            // $profile_service[] = json_encode(array("id" => $value->pivot->service_id, "price" => $value->pivot->price));
            if($value->status == '1'){
                $file_data = explode('.', $value->filename);

                $gallery_profile[] = json_encode(array( 'hash'      => $file_data[0],
                    'extension' => $file_data[1],
                    'subtitle'  => $value->subtitle,
                    'size'      => $value->size,
                    'logo'      => $value->logo));
            }
        }
        
//        echo '<pre>';
//        print_r($user);die;

        return view('admin.profiles.edit',[
            'user'              => $user,
            'products'          => Product::where('status', '1')->get(),
            'services'          => Service::where('status', '1')->get(),
            'payers'            => Payer::where('status', '1')->get(),
            'city'              => $city,
            'state'             => $state,
            'detached_value'    => $detached_value,
            'remaining_days'    => '',
            'profile_service'   => (!empty($profile_service)) ? json_encode($profile_service) : '',
            'gallery_profile'   => (!empty($gallery_profile)) ? json_encode($gallery_profile) : '',
            'model'             => 'User'

        ]);
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

//        echo '<pre>';
//        print_r($request->all());die;

        //-- Se na tela de listagem o usuário clicou para mudar o status do registro, o update é chamado via AJAX.
        //-- Caso contrário, o form está sendo atualizado pelo botão SALVAR
        if($request->ajax()){
            parent::update($request, $id);
        }else{

            $params = $request->all();
//echo '<pre>';
//print_r($params);die;
            $user = User::find($params['user_id']);

            //$params             = $request->all();
//            $params['user_id']  = $user->id;

            echo '<pre>';print_r($params);//die;
             $state  = json_decode($params['state'], true);
             $city   = json_decode($params['city'], true);

            //-- Clean up special chars
            $to_be_removed                   = array(".", ",", "/", "(", ")", "-", " ");
            $params['document']              = str_replace($to_be_removed, '', $params['document']);
            $params['responsible_cellphone'] = str_replace($to_be_removed, '', $params['responsible_cellphone']);
            $params['zip_code']              = str_replace($to_be_removed, '', $params['zip_code']);
            $params['whatsapp']              = str_replace($to_be_removed, '', $params['whatsapp']);
            $params['state']                 = $state['code'];
            $params['city']                  = $city['id'];

            if(!empty($user->profiles)){ //-- Update
                $user->profiles->fill($params)->save();
                $operation = 'update';
            }else{ //-- Create
                $profile  = Profile::create($params);
                $operation = 'create';
            }

            //-- Attach images
            $gallery    = json_decode($params['uploads'], true);

            if(count($gallery)){

                $user->profiles->galleries()->detach();

                foreach($gallery as $img){
                    $img = json_decode($img);
                    $img->filename = $img->hash . '.' . $img->extension;

                    echo '<pre>';print_r($img);//die;
                    $id_img = Gallery::create((array)$img)->id;

                    $user->profiles->galleries()->attach($id_img);
                }
            }

// echo '<pre>';print_r($params);//die;
            //-- Attach services
            $services   = json_decode($params['services'], true);
// print_r($services);
// print_r(json_decode($service));
            if(count($services)){
                foreach($services as $service){
                    $service        = json_decode($service);
// print_r($service);
                    $service->price = ($service->price == 'Sob consulta') ? 0 : $service->price;
                    $service->price = str_replace('.', '' , $service->price);
                    $service->price = str_replace(',', '.', $service->price);

                    $profile_service[] = ["service_id" => $service->id, "price" => $service->price];
                }
                $user->profiles->services()->detach();
                $user->profiles->services()->attach($profile_service);
            }



            //-- Save purchase just if it is courtesy
            // if(!empty($params['product_id'])){
            $product = explode('#', $params['product_id']);
            if($product[0] = '1'){
                $purchase = array(  'product_id'         => '1',
                    'transaction_id'    => 'free',
                    'transaction_date'  => date('Y-m-d H:m:s'),
                    'payer_id'          => '',
                    'status_id'         => 2,
                    'detached'          => '0',
                    'courtesy'          => '1');

                $user->purchases()->create($purchase);
            }

            //}

            if($operation == 'create'){
                $msg    = 'Seu cadastro foi criado com sucesso ! ';
            }else{
                $msg    = 'Seu cadastro foi atualizado com sucesso ! ';
            }

            $type   = 'success';

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//    public function destroy($id)
//    {
//        //
//    }



    public function nova_senha(Request $request)
    {

        $user = User::find($request->id);

        $params = User::find($request->id)->toArray();

        $nova_pass = str_random(6);

        $params['nova_senha'] = $nova_pass;

        Mail::send('novasenha_mensagem',  ['params' => $params], function ($m) use ($params) {
            $m->from('locness.dev@gmail.com', 'Portal IBA');

            $m->to($params['email'], $params['name'])->subject('Admin IBA - Nova senha');
        });

        if (Mail::failures()) {
            echo 'erro';die;
        }else{
            $user->password = md5($nova_pass);
            $user->save();
        }

    }




    public function showLogin()
    {
        \Session::forget('usuario');
        return view('admin.login');
    }


    public function doLogout(Request $request)
    {
        \Session::forget('usuario');

        return view('admin.login');
    }

    public function doLogin(Request $request)
    {

        $autenticado = User::where('email', strtolower($request->email))->where('password', md5($request->password))->first();

//        echo '<pre>';
//        print_r($autenticado);die;
        if(count($autenticado))
        {
            $request->session()->put('usuario', [
                                                    'id'            => $autenticado->id,
                                                    'name'          => $autenticado->name,
                                                    'email'         => $autenticado->email
                                                ]);

            return \Redirect::to('/admin');

        }else{

            return view('admin.login',
                [
                    'mensagem'         => 'Usuário/Senha inválidos'
                ]);
        }

    }
    
    
}
