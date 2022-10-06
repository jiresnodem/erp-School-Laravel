<?php

namespace App\Http\Controllers\BackOffice;

use Exception;


use App\Models\Student;
use App\Models\Trainning;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();


        return view('BackOffice.student.index', compact('students'));
    }

    public function ShowRegistration()
    {
        $trainnings = Trainning::all();

        return view('BackOffice.student.create', compact('trainnings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function studentStore(Request $request)
    {


        $validatedData = Validator::make($request->all(), [

            'email' => 'required|unique:students',
            'last_name' => 'required',
            'first_name' => 'required',
            'student_phone' => 'required',
            'trainning_id' => 'required',
            'registration_fees' => 'required',
            'pay_type' => 'required',
            'image' => 'mimes:jpg,png,jpeg|max:5048'

        ]);

        if ($validatedData->fails()) {
            Toastr::error('Les champs ne peuvent pas etre vide !', 'Verify', ["positionClass" => "toast-top-right"]);
            return redirect()->back()
                ->withErrors($validatedData)
                ->withInput();
        }

        try {
            $trainning = Trainning::find($request->trainning_id)->title;
            
            $matricule = date('Y', time()) . '-' . substr($trainning, 0, 3) . random_int(1, 2022);

            
            $data = new Student();
            $data->first_name = $request->first_name;
            $data->last_name = $request->last_name;
            $data->email = $request->email;
            $data->address = $request->address;
            $data->gender = $request->gender;
            $data->student_phone = $request->student_phone;
            $data->matricule = $matricule;
            $data->registration_fees = $request->registration_fees;
            $data->parent_name = $request->parent_name;
            $data->parent_phone = $request->parent_phone;
            $data->pay_type = $request->pay_type;
            $data->trainning_id = $request->trainning_id;

            if ($request->file('image')) {
                $file = $request->file('image');
                @unlink(public_path('upload/user_images/' . $data->image));
                $filename = date('YmdHi') .'_'. $request->first_name.$request->last_name.'.'.$file->extension();
                $file->move(public_path('upload/Student_images'), $filename);
                $data->student_photo_path = $filename;
            }

            $data->save();
            Toastr::success('Successfully !!!', 'Registration', ["positionClass" => "toast-top-right"]);
        } catch (Exception $e) {
            Toastr::info('Faild!', 'Registration', ["positionClass" => "toast-top-right"]);
        }
        return redirect()->back();
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function showStudent($id)
    {
        $student = Student::find($id);

        return view('BackOffice.student.showStudent', compact('student'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function editStudent($id)
    {
        $student = Student::find($id);
        $trainnings = Trainning::all();

        return view('BackOffice.student.editStudent', compact('student', 'trainnings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function UpdateStudent(Request $request, $id)
    {


        $validatedData = Validator::make($request->all(), [

            'email' => 'required',
            'last_name' => 'required',
            'first_name' => 'required',
            'student_phone' => 'required',
            'trainning_id' => 'required',
            'registration_fees' => 'required',
            'pay_type' => 'required',
            'image' => 'mimes:jpg,png,jpeg|max:5048'
        ]);

        if ($validatedData->fails()) {
            Toastr::error('Les champs ne peuvent pas etre vide !', 'Verify', ["positionClass" => "toast-top-right"]);
            return redirect()->back()
                ->withErrors($validatedData)
                ->withInput();
        }

        try {
            $data = Student::find($id);
            $data->first_name = $request->first_name;
            $data->last_name = $request->last_name;
            $data->email = $request->email;
            $data->address = $request->address;
            $data->gender = $request->gender;
            $data->student_phone = $request->student_phone;
            $data->parent_name = $request->parent_name;
            $data->parent_phone = $request->parent_phone;
            $data->pay_type = $request->pay_type;
            $data->trainning_id = $request->trainning_id;


            if ($request->file('image')) {
                $file = $request->file('image');
                @unlink(public_path('upload/user_images/' . $data->image));
                $filename = date('YmdHi') .'_'. $request->first_name.$request->last_name.'.'.$file->extension();
                $file->move(public_path('upload/Student_images'), $filename);
                $data->student_photo_path = $filename;
            }

            $data->update();
           Toastr::success('Successfully !!!', 'Modification', ["positionClass" => "toast-top-right"]);
        } catch (Exception $e) {
            Toastr::info('Failed!', 'Modification', ["positionClass" => "toast-top-right"]);
        } 

        return redirect()->route('student.list');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function deleteStudent($id)
    {
        try {

            $student = Student::find($id);
            $student->delete();
            Toastr::success('Successfully !!!', 'Deletion', ["positionClass" => "toast-top-right"]);
        } catch (Exception $e) {
            Toastr::info('Failed!', 'Deletion', ["positionClass" => "toast-top-right"]);
        }

        return back();
    }
}
