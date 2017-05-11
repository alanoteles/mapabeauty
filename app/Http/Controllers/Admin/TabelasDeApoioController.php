<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TabelasDeApoioController extends Controller
{
    public function index(){

        return view('admin.tabelas-de-apoio.index');
    }
}
