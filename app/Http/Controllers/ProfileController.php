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
use App\Neighborhood;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use DB;

//use App\Http\Requests;
use App\City;
use App\Product;
use Psy\Util\Json;

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


        $detached_value = number_format(Product::where('status', 'D')->value('value'),2,',','.');
    //echo 'aa : '. Auth::check();die;
        if(Auth::check()){
            //echo 'sess : '. session('msg');
            if(session()->has('msg')){
                $message = ['msg' => session('msg'), 'type' => session('type')];
                print_r($message);
            }
//print_r($params);
            //$id =  Auth::user()->id;
  //echo 'aaaa';die;
            //$user = User::join('profiles', 'profiles.user_id', '=', 'users.id')
            //        ->where('users.id', $id)->first();

// echo $user;//die;
            //if(count($user) == 0){ //-- User does not have profile yet
   // echo '<pre>';//die;
   // echo count($user);//die
                //$user = User::find($id);
// print_r($user);//die
                //$city       = City::find($user->city);
                //$city_name  = $city->name;

                //$state      = State::find($city->state_id);
                //$state_name = $state->name;
            //}else{
            $user = User::find(Auth::user()->id);

            if(!empty($user->profiles)){
                $city   = City::find($user->profiles->city);
                $state  = State::where('code', $user->profiles->state)->first();

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
                //echo '<pre>';print_r($gallery_profile);
                
            }
            //}

            return view('layouts.profile', [
                    'page' => '1',
                    'products'          => Product::where('status', '1')->get(),
                    'services'          => Service::where('status', '1')->get(),
                    'payers'            => Payer::where('status', '1')->get(),
                    'user'              => $user,
                    'detached_value'    => $detached_value,
                    'remaining_days'    => '',
                    'city'              => (!empty($city)) ? $city : '',
                    'state'             => (!empty($state)) ? $state : '',
                    'profile_service'   => (!empty($profile_service)) ? json_encode($profile_service) : '',
                    'gallery_profile'   => (!empty($gallery_profile)) ? json_encode($gallery_profile) : '',
                    'message'           => (!empty($params['message'])) ? $params['message'] : ''
                ]);

           
        }else{
            return redirect('login');
        }

       // echo '<pre>';
       // print_r($user);die;

       //-- Value to be paid if user wants to be detached
        // $detached_value = number_format(Product::where('status', 'D')->value('value'),2,',','.');
        
        // return view('layouts.profile', [
        //             'page' => '2',
        //             'cities'    => City::get(),
        //             'states'    => State::get(),
        //             'products'  => Product::get(),
        //             'services'  => Service::get()

        // ]);
        // return view('layouts.profile', [
        //         'page' => '1',
        //         'cities'            => City::get(),
        //         'states'            => State::get(),
        //         'products'          => Product::where('status', '1')->get(),
        //         'services'          => Service::where('status', '1')->get(),
        //         'payers'            => Payer::where('status', '1')->get(),
        //         'user'              => $user,
        //         'detached_value'    => $detached_value,
        //         'remaining_days'    => ''
        //     ]);
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
        
        //-- Profile are saved only when a valid user is logged in
        if(Auth::check()){
            $user = Auth::user();
            
            $params             = $request->all();
            $params['user_id']  = $user->id;

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
            }else{ //-- Create
                $profile  = Profile::create($params);
            }

            //-- Attach images
            $gallery    = json_decode($params['uploads'], true);

            if(count($gallery)){
                
                $user->profiles->galleries()->detach();

                foreach($gallery as $img){
                    $img = json_decode($img);
                    $img->filename = $img->hash . '.' . $img->extension;
                    $id_img = Gallery::create((array)$img)->id;

                    $user->profiles->galleries()->attach($id_img);
                }
            }


            //-- Attach services
            $services   = json_decode($params['services'], true);
            if(count($services)){
                foreach($services as $service){
                    $service        = json_decode($service);
                    $service->price = ($service->price == 'Sob consulta') ? 0 : $service->price;
                    $service->price = str_replace('.', '' , $service->price);
                    $service->price = str_replace(',', '.', $service->price);

                    $profile_service[] = ["service_id" => $service->id, "price" => $service->price];
                }
                $user->profiles->services()->detach();
                $user->profiles->services()->attach($profile_service);
            }

            $msg    = 'Seu cadastro foi criado com sucesso ! ';
            $type   = 'success';

        }else{

            $msg    = 'Seu cadastro foi não foi criado. Por favor tente novamente. Obrigado ! ';
            $type   = 'danger';
        }

        $message = ['msg' => $msg, 'type' => $type];
//print_r($message);
        return redirect('profile')->with('msg', ['Seu cadastro foi criado com sucesso ! '])->with('type', ['success']);
        //return redirect()->back()->with($message);

        // $user = User::create(array(
        //     'name'  => $params['responsible_name'],
        //     'email' => $params['responsible_email'],
        // ));
        
// echo '<pre>';print_r($user);die;

        

        


//        foreach($gallery as $img){
//
//            $img['filename'] = $img['hash'] . '.' . $img['extension'];
//            Gallery::create($img);
//        }

        
        // echo '<pre>';
        // print_r($gallery);
        // print_r($services);
        // //$data = json_decode($params['uploads'], true);
        // print_r($params);die;
        // echo 'www';die;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
// echo 'show';die;
//echo '<pre>';print_r(Auth::check());die;
        if(Auth::check()){ //-- User is authenticated
// echo 'if';die;
            $user_data = Auth::user();
// echo $user_data->id;
// echo Auth::user()->value('id');die;

// echo '<pre>';print_r(Auth::user());die;
            $id = $user_data->id;
// echo $id;die;
            $user = User::join('profiles', 'profiles.user_id', '=', 'users.id')
                        ->where('users.id', $id)->first();

            if(count($user)){ //-- If user has a profile, return his purchases

                //-- Check if the user have a valid purchase and how many days left
                $purchases = Purchase::where('user_id', $id)->orderBy('created_at')->first();

                // $city = City::find($user->city);

// echo '<pre>';print_r($user->city);die;

                $city_name = (!empty($user->city)) ? City::find($user->city)->value('name') : '';

                //$state = State:find($city_name)
                //$state_name
                
                if(count($purchases)){ //-- Calculate remaining days
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
                    'city_name'         => $city_name,
                    'states'            => State::get(),
                    'products'          => Product::where('status', '1')->get(),
                    'services'          => Service::where('status', '1')->get(),
                    'payers'            => Payer::where('status', '1')->get(),
                    'user'              => $user,
                    'detached_value'    => $detached_value,
                    'purchase'          => ( count($purchases) ? $purchases[0] : ''),
                    'remaining_days'    => ( !empty($remaining_days) ? $remaining_days : '')

                ]);
            }else{ //-- User does not have a profile. Redirect to fill the form
                //return redirect('login');
                return redirect('profile');
            }
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



    /**
     * Return to AJAX cities from selected state.
     *
     * @param  string  $code
     * @return Json
     */
    public function returnCities(Request $request)
    {
        $params = $request->all();

        $state_id = State::where('code', $params['code'])->first();
        
//        echo '<pre>';
//        print_r($state_id->id);die;
        $cities = City::where('state', $state_id->code)->get();

        return $cities;
//        print_r($cities);
//        echo $code;
    }


    /**
     * Return to AJAX neighbohoods from selected city.
     *
     * @param  string  $city_id
     * @return Json
     */
    public function returnNeighborhood(Request $request)
    {
        $params = $request->all();

        $neighborhoods = Neighborhood::where('city_id', $params['id'])->get();

        return $neighborhoods;

    }




}
