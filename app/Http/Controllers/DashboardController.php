<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index_welcome()
    {
        return view('dashboard.index_welcome');
    }
}
