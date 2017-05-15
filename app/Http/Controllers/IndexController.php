<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\State;
use App\Service;
use App\Profile;
use App\Product;
use App\Banner;
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
            $profile = Profile::where('user_id', $id)->first();


            if(!empty($user))
            $user = ( !empty($user) ? $user : '' );
            // if(count($user) == 0){

        }
//        else{
//            return redirect('login');
//        }
        //curl freegeoip.net/json/82.0.175.11

        $results = '';
        $profiles            = Profile::where('status', '1')->get();
        foreach ($profiles as $key => $profile) {

            $results[$key] = array( 'id'                => $profile->id,
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

        //-- Order array by "detached" field.
        if(count($results)){
            usort($results, function ($a, $b) { return strcmp($b["detached"], $a["detached"]); });
        }

        $banner = Banner::where('status', '1')->first();

        return view('layouts.index', [
            'states'    => State::get(),
            'services'  => Service::get(),
            'results'   => $results,
            'banner'    => (!empty($banner) ? $banner : '')
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
    public function show($id = '')
    {
        $profile = Profile::find($id);

        if(!empty($profile)){

            $reviews = round($profile->stars / $profile->reviews);

            $profile->views = $profile->views + 1;
            $profile->save();
         
            return view('layouts.detail',
                [
                    'profile'           => $profile,
                    'reviews'           => $reviews
                ]);
        }
        return redirect('/');
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

        $query = "SELECT A.id
                  FROM `profiles` A
                  WHERE status = '1'";


        if(!empty($params['select-state'])){

            $query .= " AND A.state   = '" . $params['select-state'] . "'";

            if(!empty($params['select-city'])){
                $query .= " AND A.city   = " . $params['select-city'];

                if(!empty($params['select-neighborhood'])){

                    $query .= " AND A.neighborhood   LIKE '%" . $params['select-neighborhood'] . "%'";
                }
            }
        }

        $profiles = DB::select(DB::raw($query));
        $results = array();

        $id_profiles        = array();
        foreach ($profiles as $profile) {
            $id_profiles[] = $profile->id;
        }
        $id_profiles_ordered = implode(',', $id_profiles);//Necessário para manter ordenação dos IDs
        $profiles            = Profile::whereIn('id', $id_profiles)->get();

//echo '<pre>';
//print_r($profiles);//die;

        foreach ($profiles as $key => $profile) {

            if(!empty($params['select-service'])){

                $service = $profile->services->find($params['select-service']);

                if($service){ //-- If professional has the service on his profile...
                    $results[$key] = array( 'id'                => $profile->id,
                                            'professional_name' => $profile->professional_name,
                                            'fantasy_name'      => $profile->fantasy_name,
                                            'about'             => $profile->about,
                                            'logo'              => '',
                                            'detached'          => '');
                }else{
                    continue;
                }

            }else{
                $results[$key] = array( 'id'                => $profile->id,
                                        'professional_name' => $profile->professional_name,
                                        'fantasy_name'      => $profile->fantasy_name,
                                        'about'             => $profile->about,
                                        'logo'              => '',
                                        'detached'          => '');

            }

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

        //-- Order array by "detached" field.
        if(count($results)){
            usort($results, function ($a, $b) { return strcmp($b["detached"], $a["detached"]); });
        }



        $banner = Banner::where('status', '1')->first();

        return view('layouts.index', [
            'states'    => State::get(),
            'services'  => Service::get(),
            'results'   => $results,
            'banner'    => (!empty($banner) ? $banner : '')
        ]);
        

//        echo $query;
//       print_r($params);//die;
//        print_r($profiles);
        // return $neighborhoods;

    }
}
