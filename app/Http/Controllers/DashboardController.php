<?php

namespace App\Http\Controllers;

use App\Models\PaymentsModel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index(){


        return view('dashboard');
    }
}
