<?php
/**
 * Created by PhpStorm.
 * User: fabricioromao
 * Date: 08/06/16
 * Time: 18:06
 */

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class IndexController extends Controller
{
    public function index(Request $request){

//        echo 'aaa';die;
        return view('admin.index');
    }


    public function showLogin()
    {
        // show the form
        return view('admin.login');
    }


    public function doLogout(Request $request)
    {
        return view('admin.login');
    }

    public function doLogin(Request $request)
    {

        $autenticado = User::where('email', strtolower($request->email))->where('password', md5($request->password))->get();
//echo '<pre>';
//print_r($autenticado);die;
        if($autenticado->count() == 0){
            return view('admin.login',
                [
                'mensagem'         => 'Usuário/Senha inválidos'
                ]);
        }else{
            //return \Redirect::to(app()->getLocale() . '/admin');
            return view('admin.index',
                [
                    'nome_usuario'         => $autenticado[0]->name
                ]);
        }

//
//        echo $autenticado->count();
//        echo '<pre>';
//        print_r($autenticado);die;
//
//// validate the info, create rules for the inputs
//        $rules = array(
//            'email'    => 'required|email', // make sure the email is an actual email
//            'password' => 'required|min:3' // password can only be alphanumeric and has to be greater than 3 characters
//        );
//
//// run the validation rules on the inputs from the form
//        $validator = Validator::make($request->all(), $rules);
//        //$validator = Validator::make($params, $rules);
//
//// if the validator fails, redirect back to the form
//        if ($validator->fails()) {
//            echo 'fail';die;
//            //return Redirect::to('/pt_br/admin/login')
//                return \Redirect::to(app()->getLocale() . '/admin/login')
//                ->withErrors($validator) // send back all errors to the login form
//                ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
//        } else {
//            //echo ' not fail';die;
//            // create our user data for the authentication
//            $userdata = array(
//                'email'     => $request->email,
//                'password'  => md5($request->password)
//            );
//echo '<pre>';
//print_r($userdata);//die;
//            // attempt to do the login
//            if (Auth::attempt(['email' => 'alanoteles@gmail.com', 'password' => '$2y$10$3S3yDwfkwwLghedu4AoaTe//61QTaNC0ycTdp8hLfHtQS4XrgBPQy'])) {
//                echo 'if';die;
//                // validation successful!
//                // redirect them to the secure section or whatever
//                // return Redirect::to('secure');
//                // for now we'll just echo success (even though echoing in a controller is bad)
//                echo 'SUCCESS!';
//
//            } else {
//                echo 'else';die;
//                // validation not successful, send back to form
//                return \Redirect::to(app()->getLocale() . '/admin/login');
//
//            }
//
//        }
    }


}