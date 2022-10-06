<?php

namespace App\Http\Controllers\BackOffice;

use App\Models\Balance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;



class DashboardController extends Controller
{
  public function showDashboard(){
    $balance = Balance::all();
    $sum_balance = DB::table('balances')->sum('balance');
    $sum_student = DB::table('students')->count();
    $sum_trainning = DB::table('trainnings')->count();
    $sum_expense = DB::table('expenses')->sum('amount');

    return view('BackOffice.dashboard.dashboard', compact('balance', 'sum_balance', 'sum_student', 'sum_trainning', 'sum_expense'));
  }
}
