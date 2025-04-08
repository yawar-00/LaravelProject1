<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class service extends Controller
{
    public function getservice(){
        return view('service');
    }
    public function getservice1(){
        return view('service1');
    }
    public function getservice2(){
        return view('service2');
    }
}
