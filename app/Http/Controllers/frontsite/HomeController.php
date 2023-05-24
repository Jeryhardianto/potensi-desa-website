<?php

namespace App\Http\Controllers\frontsite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.frontsite.home');
    }
}
