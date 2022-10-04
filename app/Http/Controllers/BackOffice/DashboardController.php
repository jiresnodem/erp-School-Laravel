<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;



class DashboardController extends Controller
{
  public function showDashboard(){
    return view('BackOffice.dashboard.dashboard');
  }
}
