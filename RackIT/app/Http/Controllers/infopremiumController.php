<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class infopremiumController extends Controller
{
    //
    public function index(){
        return view ('infoPremium/infoPremium');
    }
}