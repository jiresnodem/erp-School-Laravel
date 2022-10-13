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
        if (!empty(DB::table('students')->where('matricule', $request->maricule)->first())) {

            $student =  DB::table('students')->where('matricule', $request->maricule)->first();
            $id = $student->trainning_id;
            $data_trainning = Trainning::find($id);
            $total_payment = DB::table('payments')->where('student_id', $student->id)->sum('amount_pay');
        }

        if (!empty($student)) {
            if ($student->pay_type === 'slice') {

                return view('BackOffice.payment.slicePayment', compact('student', 'data_trainning', 'total_payment'));
            } elseif ($student->pay_type === 'complet') {

                return view('BackOffice.payment.completPayment', compact('student', 'data_trainning', 'total_payment'));
            }
            Toastr::info('Type !!!', 'Type of payment not exist', ["positionClass" => "toast-top-right"]);
        }
        Toastr::info('does not match !!!', 'the information entered does not correspond to any student ', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }



    public function paymentStore(Request $request)
    {

        $validatedData = Validator::make($request->all(), [
            'student_id' => 'required',
            'trainning_id' => 'required',
            'matricule' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'student_phone' => 'required',
            'email' => 'required',
            'trainning' => 'required',
            'amount_pay' => 'required',


        ]);
        //   dd($validatedData);

        if ($validatedData->fails()) {
            Toastr::error('Les champs ne peuvent pas etre vide !', 'Verify', ["positionClass" => "toast-top-right"]);
            return redirect()->back()
                ->withErrors($validatedData)
                ->withInput();
        }

        try {

            $trainning = Trainning::find($request->trainning_id);
            $total_payment = DB::table('payments')->where('student_id', $request->student_id)->sum('amount_pay');

            if ($total_payment == $trainning->amount) {

                Toastr::info('tuition has already been paid in full !!!', 'New', ["positionClass" => "toast-top-right"]);
                return redirect()->back();
            }

            if ($request->amount_pay ==  $trainning->amount) {

                $balance = new Balance();
                $data = new Payment();
                $data->amount_pay = $request->amount_pay;
                $data->student_id = $request->student_id;
                $data->trainning_id = $request->trainning_id;
                $data->save();
                $balance->balance = $request->amount_pay;
                $balance->save();

                Toastr::success('Successfully !!!', 'Registration', ["positionClass" => "toast-top-right"]);

                $student = Student::find($request->student_id);
                $trainning = Trainning::find($student->trainning_id);

                $i = 1;
                $pdf = PDF::loadView('BackOffice.invoice.invoice', ['student' => $student, 'trainning' => $trainning, 'amount_pay' => $request->amount_pay, 'i' => $i ]);

                $filename = 'invoice' . $student->last_name . $i . '.pdf';
                $path = public_path('upload/invoice');
                $pdf->save(public_path("upload/invoice/" . $filename));
                //   $content = $pdf->download()->getOriginalContent();
                return $pdf->stream();
            } else {

                Toastr::error('The amount entered does not correspond to the amount of the training fees!', 'Verify', ["positionClass" => "toast-top-right"]);
                return redirect()->back();
            }
        } catch (Exception $e) {
            dd($e);
            Toastr::info('Faild!', 'Registration', ["positionClass" => "toast-top-right"]);
        }
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
