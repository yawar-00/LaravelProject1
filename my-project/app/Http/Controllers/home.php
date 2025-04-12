<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class Home extends Controller
{
    function loadLandig(){
        return view('index');
    }
    function loadStudent(){
        return view('student.index');
    }
    function storeStudent(Request $request){
        // echo("blaaaaaaa");
        $tbl = new Student;
        parse_str($request->input('data'),$formData);
        $tbl->name=$formData['name'];
        $tbl->enroll=$formData['enroll'];
        $tbl->save();
    }
}
