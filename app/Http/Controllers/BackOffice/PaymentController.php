<?php

namespace App\Http\Controllers\BackOffice;

use PDF;
use Exception;
use App\Models\Balance;
use App\Models\Payment;
use App\Models\Student;
use App\Models\Trainning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::all();

        return view('BackOffice.payment.index', compact('payments'));
    }


    public function createPayment()
    {
        return view('BackOffice.payment.create');
    }


    public function searchPaymentType(Request $request)
    {
        if (!empty(DB::table('students')->where('matricule', $request->maricule_lastname)->first())) {

            $student =  DB::table('students')->where('matricule', $request->maricule_lastname)->first();
            $id = $student->trainning_id;
            $data_trainning = Trainning::find($id);
        } elseif (!empty(DB::table('students')->where('last_name', $request->maricule_lastname)->first())) {

            $student =  DB::table('students')->where('last_name', $request->maricule_lastname)->first();
            $id = $student->trainning_id;
            $data_trainning = Trainning::find($id);
        }

        if (!empty($student)) {
            if ($student->pay_type == 'slice') {

                return view('BackOffice.payment.completPayment', compact('student', 'data_trainning'));
            } elseif ($student->pay_type == 'complet') {

                return view('BackOffice.payment.slicePayment', compact('student', 'data_trainning'));
            }
            Toastr::info('Type !!!', 'Type of payment not exist', ["positionClass" => "toast-top-right"]);
        }
        Toastr::info('does not match !!!', 'the information entered does not correspond to any student ', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }



    public function paymentStore(Request $request)
    {

        $validatedData = Validator::make($request->all(), [
            'last_name' => 'required',
            'first_name' => 'required',
            'trainning' => 'required',
            'amount_pay' => 'required',
            'student_id' => 'required',
            'matricule' => 'required',
            'student_phone' => 'required',
            'email' => 'required',
            'registration_fees' => 'required',
        ]);
        //  dd($request);

        if ($validatedData->fails()) {
            Toastr::error('Les champs ne peuvent pas etre vide !', 'Verify', ["positionClass" => "toast-top-right"]);
            return redirect()->back()
                ->withErrors($validatedData)
                ->withInput();
        }

        try {
            $balance = new Balance();
            $data = new Payment();
            $data->amount_pay = $request->amount_pay;
            $data->student_id = $request->student_id;
            $data->save();
            $balance->balance = $request->amount_pay;
            $balance->save();
            $student = Student::find($request->student_id);
            $trainning = Trainning::find($student->trainning_id);
         
            // $new_balance = $balance + $request->amount_pay;
            // DB::table('balances')->where('id', 1)->update(['balance' => $new_balance]);

            Toastr::success('Successfully !!!', 'Registration', ["positionClass" => "toast-top-right"]);
        } catch (Exception $e) {
            // dd($e);
            Toastr::info('Faild!', 'Registration', ["positionClass" => "toast-top-right"]);
        }

        $pdf = PDF::loadView('BackOffice.invoice.invoice', ['student' => $student , 'trainning' => $trainning ]);
        $filename = 'invoice'.$student->last_name.'.pdf';
        $path = public_path('upload/invoice');
        // $pdf->save($path.'/'.$filename);

//   $content = $pdf->download()->getOriginalContent();
//   $content->move(public_path('upload/invoice'), $filename);
// dd($filename);
        return $pdf->download($filename)->stream();

         return  redirect()->route('dashboard');
    }




    public function showPayment($id)
    {
        $payment = Payment::find($id);

        return view('BackOffice.payment.index', compact('payment'));
    }



    public function deletePayment($id)
    {
        try {

            $student = Payment::find($id);
            $student->delete();
            Toastr::success('Successfully !!!', 'Deletion', ["positionClass" => "toast-top-right"]);
        } catch (Exception $e) {
            Toastr::info('Failed!', 'Deletion', ["positionClass" => "toast-top-right"]);
        }

        return back();
    }
}
