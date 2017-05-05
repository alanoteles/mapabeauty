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

    protected $itens_por_pagina = 10;

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
        //return view('admin.noticias.edit',[ 'editorias'         => NewsEditorial::get()]);

        return view('admin.usuarios.edit',[
            'grupos'            => UserGroup::get(),
            'idiomas'           => Language::get(),
            'escolaridade'      => Schooling::get(),
            'city'              => 'Brasília',
            'state'             => 'DF',

            'model'             => 'User'

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

        $params = $request->all();
        $params['birthday'] = date("Y-m-d",strtotime(str_replace('/', '-',$params['birthday'])));

        $params['document'] = str_replace('.','', $params['document']);
        $params['document'] = str_replace('-','', $params['document']);

        $params['zip']      = str_replace('.','', $params['zip']);
        $params['zip']      = str_replace('-','', $params['zip']);

        $params['mobile_phone']      = $params['ddd'] . str_replace('-','', $params['mobile_phone']);

        $params['username'] = $params['email'];
        $params['password'] = md5($params['password']);

        $params['user_id'] = User::create($params)->id;



        //Salvando imagem 'cropada'
        if ($params['base64_image']!=null){

            //Removendo os dados da string base64 referente ao tipo de dado
            //data:image/jpeg;base64,...
            list($type,$data)   = explode(';',$params['base64_image']);
            list(,$data)        = explode(',', $data);
            //Decodificando para binário
            $image  = base64_decode($data);
            $fp     = fopen('uploads/usuarios/' . $params['user_id'] . '_m.jpg','wb+');
            fwrite($fp,$image);
            fclose($fp);

            $params['avatar'] = $params['user_id'] .'_m.jpg';

        }


        UserDetail::create($params);


        return redirect( app()->getLocale() . '/admin/usuarios')->with('success','Dados salvos com sucesso !');

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
        //-- Se na tela de listagem o usuário clicou para mudar o status do registro, o update é chamado via AJAX.
        //-- Caso contrário, o form está sendo atualizado pelo botão SALVAR
        if($request->ajax()){
            parent::update($request, $id);
        }else{

            $params = $request->all();
            $params['birthday'] = date("Y-m-d",strtotime(str_replace('/', '-',$params['birthday'])));

            $params['document'] = str_replace('.','', $params['document']);
            $params['document'] = str_replace('-','', $params['document']);

            $params['zip']      = str_replace('.','', $params['zip']);
            $params['zip']      = str_replace('-','', $params['zip']);

            $params['mobile_phone']      = $params['ddd'] . str_replace('-','', $params['mobile_phone']);




//echo '<pre>';
//print_r($params);die;
            $usuario = User::find($id);

            //Salvando imagem 'cropada'
            if ($params['base64_image']!=null){

                //Removendo os dados da string base64 referente ao tipo de dado
                //data:image/jpeg;base64,...
                list($type,$data) = explode(';',$params['base64_image']);
                list(,$data) = explode(',', $data);
                //Decodificando para binário
                $image = base64_decode($data);
                $fp = fopen('uploads/usuarios/'.$id.'_m.jpg','wb+');
                fwrite($fp,$image);
                fclose($fp);

                $usuario->user_detail->avatar = $id.'_m.jpg';

            }

            if(!empty($params['password'])){
                $usuario->password = md5($params['password']);
            }

            $usuario->status                                    = $params['status'];
            $usuario->name                                      = $params['name'];
            $usuario->email                                     = $params['email'];
            $usuario->user_group_id                             = $params['user_group_id'];
            //$usuario->password                                  = $params['password'];
            $usuario->user_detail->document                     = $params['document'];
            $usuario->user_detail->birthday                     = $params['birthday'];
            $usuario->user_detail->locale                       = $params['locale'];
            $usuario->user_detail->about                        = $params['about'];
            $usuario->user_detail->mobile_phone                 = $params['mobile_phone'];
            $usuario->user_detail->zip                          = $params['zip'];
            $usuario->user_detail->neighborhood                 = $params['neighborhood'];
            $usuario->user_detail->address                      = $params['address'];
            $usuario->user_detail->complement                   = $params['complement'];
            $usuario->user_detail->number                       = $params['number'];
            $usuario->user_detail->facebook                     = $params['facebook'];
            $usuario->user_detail->twitter                      = $params['twitter'];
            $usuario->user_detail->youtube                      = $params['youtube'];
            $usuario->user_detail->blog                         = $params['blog'];
            $usuario->user_detail->schooling_id                 = $params['schooling_id'];
            $usuario->user_detail->occupation                   = $params['occupation'];
            $usuario->user_detail->lattes                       = $params['lattes'];
            $usuario->user_detail->employer                     = $params['employer'];
            $usuario->user_detail->privacy                      = $params['privacy'];
            $usuario->user_detail->notifications_my_objects     = $params['notifications_my_objects'];
            $usuario->user_detail->notifications_other_objects  = $params['notifications_other_objects'];

            $usuario->push();


            return \Redirect::to(app()->getLocale() . '/admin/usuarios')->with('success','Dados salvos com sucesso !');

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
