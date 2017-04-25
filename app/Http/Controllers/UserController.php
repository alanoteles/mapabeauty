<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
//        echo '<pre>';print_r($request->all());die;
        $params = $request->all();

        if(empty($params['novo_email']) && empty($params['nova_password']) && empty($params['name'])){ // Loging

            $user = User::where('email',$params['email'])->where('password', md5($params['password']))->first();
// echo '<pre>';
// print_r($user);
//echo count($user);die;

            if(count($user)){ //echo 'if';die;
                Auth::login($user, true);

                //echo '<pre>';
//                print_r(Auth::user());die;
                return redirect('profile'); 
            }else{ //echo 'else';die;

                $request->session()->put('error', 'Usuário não cadastrado ou senha incorreta.');
                //$request->session()->put('form', 'login');
                return redirect()->back();
                
            }
        }else{ // Creating user
            $params['provider']     = 'local';
            $params['password']     = md5($params['nova_password']);
            $params['provider_id']  = mt_rand();
            $params['email']        = $params['novo_email'];

            $user  = User::create($params);

            Auth::login($user, true);
            return redirect('profile');    
        }
        
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

    public function emailValidation(Request $request)
    {
// echo 'aaa<PRE>';
 //echo Input::post('email');
        $params = $request->all();
// print_r($_REQUEST);
// echo $params['email'];
        $user = User::where('email', $params['email'])->get();
 // echo count($user);

        return count($user);
//print_r($user);

        //     return json_encode($busca_cep);
        // }else{
        //     return '0' ;
        // }
    }
}
