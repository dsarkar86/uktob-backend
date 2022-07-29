<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index(){
        // exit('Dashboard');
        return view('pages.dashboard');
    }

    public function home(){
        echo 'Home 1 ...';
    }

    public function home2(){
        echo 'Home 2 ...';
    }

}
