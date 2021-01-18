<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    { return view('index');}
    
    public function todo()
    { return view('todos');}

    public function create()
    { return view('create');}
    
    public function zamestnanci()
    { return view('users');}
    
    public function Oddelenia()
    { return view('oddelenia');}

    public function contact()
    { return view ('shered.contact');}
}
