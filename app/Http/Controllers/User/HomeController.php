<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
{
    $globalData = 'Ini adalah data yang dapat digunakan di semua view.';
    
    view()->share('globalData', $globalData);
    
    return view('admin.home');
}
}
