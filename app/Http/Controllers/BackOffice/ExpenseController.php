<?php

namespace App\Http\Controllers\BackOffice;

use Exception;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;

class ExpenseController extends Controller
{
    
    public function index()
    {
        $expenses = Expense::all();
        $sum_expence = DB::table('expenses')->sum('amount');

        return view('BackOffice.expenses.index', compact('expenses', 'sum_expence'));
    }

    public function createExpense()
    {
        return view('BackOffice.expenses.create');
    }

    public function expenseStore(Request $request)
    {

        $validatedData = Validator::make($request->all(), [

            'email' => 'required|unique:students',
            'reason' => 'required',
            'amount' => 'required',
            'detail_reason' => 'required',

        ]);

        if ($validatedData->fails()) {
            Toastr::error('Les champs ne peuvent pas etre vide !', 'Verify', ["positionClass" => "toast-top-right"]);
            return redirect()->back()
                ->withErrors($validatedData)
                ->withInput();
        }

        try {
           
            $data = new Expense();
            $data->reason = $request->reason;
            $data->amount = $request->amount;
            $data->detail_reason = $request->detail_reason;
            $data->save();

            Toastr::success('Successfully !!!', 'Registration', ["positionClass" => "toast-top-right"]);
        } catch (Exception $e) {
            Toastr::info('Faild!', 'Registration', ["positionClass" => "toast-top-right"]);
        }
        return redirect()->back();
    }


    public function editExpense($id)
    {
        $expense = Expense::find($id);

        return view('BackOffice.expenses.create', compact('expense'));
    }

    public function updateStudent(Request $request, $id)
    {


        $validatedData = Validator::make($request->all(), [
            'email' => 'required|unique:students',
            'reason' => 'required',
            'amount' => 'required',
            'detail_reason' => 'required',

        ]);

        if ($validatedData->fails()) {
            Toastr::error('Les champs ne peuvent pas etre vide !', 'Verify', ["positionClass" => "toast-top-right"]);
            return redirect()->back()
                ->withErrors($validatedData)
                ->withInput();
        }

        try {
            $data = Expense::find($id);
            $data->reason = $request->reason;
            $data->amount = $request->amount;
            $data->detail_reason = $request->detail_reason;
            $data->save();


            $data->update();
           Toastr::success('Successfully !!!', 'Modification', ["positionClass" => "toast-top-right"]);
        } catch (Exception $e) {
            Toastr::info('Failed!', 'Modification', ["positionClass" => "toast-top-right"]);
        } 

        return redirect()->route('expense.list');
    }

    public function showExpense($id)
    {
        $expense = Expense::find($id);

        return view('BackOffice.expenses.show', compact('expense'));
    }

    public function deleteExpense($id)
    {
        try {

            $student = Expense::find($id);
            $student->delete();
            Toastr::success('Successfully !!!', 'Deletion', ["positionClass" => "toast-top-right"]);
        } catch (Exception $e) {
            Toastr::info('Failed!', 'Deletion', ["positionClass" => "toast-top-right"]);
        }

        return back();
    }
}
