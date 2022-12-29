<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class jqueryController extends Controller
{
    // show the first pages 
    public function show (){
        return view("javascript.jquery");
    }
}
