<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpaController extends Controller
{
    public function index(){
        return view('welcome'); // Assuming you have a Blade view named 'spa.blade.php'
    }
}
