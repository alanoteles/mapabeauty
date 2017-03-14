<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Http\Request;

use App\State;
use App\City;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;


    public function busca_cep(Request $request)
    {

        $busca_cep = json_decode(@file_get_contents('http://republicavirtual.com.br/web_cep.php?cep='.urlencode($request->cep).'&formato=json'));

        if($busca_cep->resultado != 0){

            $state  = State::where('code', $busca_cep->uf)->get();
            $city   = City::where('name', $busca_cep->cidade)->where('state_id', $state[0]->id)->get();

            $busca_cep->city_id     = $city[0]->id;
            $busca_cep->state_id    = $state[0]->id;
            $busca_cep->state_name  = $state[0]->name;

            return json_encode($busca_cep);
        }else{
            return '0' ;
        }


    }
}
