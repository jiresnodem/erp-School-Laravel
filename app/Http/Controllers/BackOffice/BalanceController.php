<?php

namespace App\Http\Controllers\BackOffice;

use Exception;
use App\Models\Balance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class BalanceController extends Controller
{
    public function index()
    {
        $balance = Balance::all();
        $sum_balance = DB::table('balances')->sum('balance');

        return view('BackOffice.balance.index', compact('balance', 'sum_balance'));
    }

    public function deleteBalance($id)
    {
        try {

            $student = Balance::find($id);
            $student->delete();
            Toastr::success('Successfully !!!', 'Deletion', ["positionClass" => "toast-top-right"]);
        } catch (Exception $e) {
            Toastr::info('Failed!', 'Deletion', ["positionClass" => "toast-top-right"]);
        }

        return back();
    }
}
