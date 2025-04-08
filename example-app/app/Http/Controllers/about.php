<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class about extends Controller
{
    
        public function getabout(){
            return view('about');
        }
    
}
