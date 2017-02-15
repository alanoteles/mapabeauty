<?php

namespace App\Http\Controllers;

use Mail;
use Illuminate\Http\Request;
use App\Http\Requests;

class AboutUsController extends Controller
{
    public function index(Request $request){

        //return view('layouts.profile', ['page' => $request->page]);

       return view('layouts.about',['page' => 'about']);
    }

}
