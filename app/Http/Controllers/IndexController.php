<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\State;
use App\Service;
use App\Profile;
use App\Product;
use Carbon\Carbon;
use Auth;
use DB;

use App\Http\Requests;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(Auth::check()){
            $id = Auth::user()->value('id');
// echo $id;die;
            $profile = Profile::where('user_id', $id)->get();


            if(!empty($user))
            $user = ( !empty($user[0]) ? $user[0] : '' );
            // if(count($user) == 0){

        }
//        else{
//            return redirect('login');
//        }
        //curl freegeoip.net/json/82.0.175.11

        return view('layouts.index', [
            'states'    => State::get(),
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
        //
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


    /**
     * Search tool.
     *
     *
     */
    public function search(Request $request, $termo = '', $itens_por_pagina = 5)
    {
        $params = $request->all();
//        $query = "SELECT A.id, A.professional_name, A.fantasy_name, A.about
        $query = "SELECT A.id
                  FROM `profiles` A
                  WHERE 1 = 1";
        //echo '<pre>';

        //$test = Profile::get();
        //$test = $test->where('city', (int)$params['select-city']);
        //print_r($test);
//        $query = "SELECT A.id, A.professional_name, A.fantasy_name, A.about, B.filename, B.logo";
//
//        if(empty($params['select-service'])){
//            $query .= " FROM `profiles` A
//                        WHERE 1 = 1 ";
//        }else{
//            $query .= " FROM profiles A, profile_service D
//                        WHERE A.id   = D.profile_id
//                        AND   D.service_id    = " . $params['select-service'] ;
//        }

//        if(empty($params['select-service'])){
//            $query .= " FROM `profiles` A
//                        LEFT JOIN gallery_profile C ON A.id = C.profile_id
//                        LEFT JOIN galleries B ON B.id = C.gallery_id
//                        WHERE 1 = 1 ";
//        }else{
//            $query .= " FROM profiles A, profile_service D
//                        LEFT JOIN gallery_profile C ON A.id = C.profile_id
//                        LEFT JOIN galleries B ON B.id = C.gallery_id
//                        WHERE A.id   = D.profile_id
//                        AND   D.service_id    = " . $params['select-service'] ;
//        }


        if(!empty($params['select-state'])){

            $query .= " AND A.state   = '" . $params['select-state'] . "'";
            //$test = $test->where('state', (string)$params['select-state']);

            if(!empty($params['select-city'])){
                $query .= " AND A.city   = " . $params['select-city'];
                //$test = $test->where('city', (int)$params['select-city']);

                if(!empty($params['select-neighborhood'])){

                    $term = (string)$params['select-neighborhood'];
                    $query .= " AND A.neighborhood   LIKE '%" . $params['select-neighborhood'] . "%'";
                    //$test = $test->where('neighborhood', 'LIKE', "%" . $term . "%");
                }
            }
        }

//print_r($test);
        $profiles = DB::select(DB::raw($query));
        $results = array();

        $id_profiles        = array();
        foreach ($profiles as $profile) {
            $id_profiles[] = $profile->id;
        }
        $id_profiles_ordered = implode(',', $id_profiles);//Necessário para manter ordenação dos IDs
        $profiles            = Profile::whereIn('id', $id_profiles)->get();


        foreach ($profiles as $key => $profile) {

            if(!empty($params['select-service'])){


            }else{
                $results[$key] = array( 'id'            => $profile->id,
                    'professional_name' => $profile->professional_name,
                    'fantasy_name'      => $profile->fantasy_name,
                    'about'             => $profile->about,
                    'logo'              => '',
                    'detached'          => '');


                //-- Get last purchase
                $detached = $profile->users->purchases->where('status_id',2)->sortByDesc('transaction_date')->first();//, 'desc')->get();

                if(count($detached)){ //-- Professional has acquired "detach" on the list

                    //-- Calculate remaining days
                    $created            = new Carbon($detached['transaction_date']);
                    $now                = Carbon::now();

                    $product_total_days = Product::find($detached['product_id'])->days;
                    $remaining_days     = $product_total_days - $created->diff($now)->days;

                    if($remaining_days > 0){
                        $results[$key]['detached'] = '1';
                    }

                }

                //-- Get logo, if exists
                $logo = $profile->galleries->where('logo', '1')->first();

                if(count($logo)){
                    $results[$key]['logo'] = $logo->filename;
                }
            }
        }
//die;
        echo '<pre>';
        print_r($results);die;


        return view('layouts.index', [
            'states'    => State::get(),
            'services'  => Service::get(),
            'results'   => $results
        ]);




//        echo $query;
//       print_r($params);//die;
//        print_r($profiles);
        // return $neighborhoods;

    }
}
