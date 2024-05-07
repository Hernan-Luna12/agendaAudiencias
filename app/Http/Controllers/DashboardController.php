<?php

namespace App\Http\Controllers;

setlocale(LC_ALL, 'spanish');

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{
    public function dashboard(){
        return View::make('dashboard.dashboard');
    }
}
