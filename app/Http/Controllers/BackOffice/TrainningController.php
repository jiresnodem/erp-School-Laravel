<?php

namespace App\Http\Controllers\BackOffice;

use Exception;
use App\Models\Trainning;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;

class TrainningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trainnings = Trainning::all();
        return view('BackOffice.trainning.index', compact('trainnings'));
    }

    public function showCreate()
    {
        return view('BackOffice.trainning.create');
    }

    public function showTrainning()
    {
        return view('BackOffice.trainning.showTrainning');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trainningStore(Request $request)
    {
        $validatedData = Validator::make($request->all(), [

            'title' => 'required|unique:trainnings|max:255',
            'amount' =>  Rule::requiredIf($request->amount === ($request->first_slice + $request->second_slice + $request->third_slice)),
            'first_slice' => 'required',
            'second_slice' => 'required',
            'third_slice' => 'required',
            'duration' => 'required',
            'short_description' => 'required',

        ]);

        if ($validatedData->fails()) {
            Toastr::error('Les champs ne peuvent pas etre vide !', 'Verify', ["positionClass" => "toast-top-right"]);
            return redirect()->back()
                ->withErrors($validatedData)
                ->withInput();
        }

        // dd($request->image);
        try {
            $data = new Trainning();
            $data->title = $request->title;
            $data->duration = $request->duration;
            $data->amount = $request->amount;
            $data->first_slice = $request->first_slice;
            $data->second_slice = $request->second_slice;
            $data->third_slice = $request->third_slice;
            $data->short_description = $request->short_description;
            $data->long_description = $request->long_description;

            if ($request->image) {
                $file = $request->image;
                $filename = date('YmdHi') . '_' . $request->title . '.' . $file->extension();
                $file->move(public_path('upload/formation_images'), $filename);
                $data->trainning_photo_path = $filename;
                // dd($filename);
            }


            $data->save();
            Toastr::success('Successfully !!!', 'Registration', ["positionClass" => "toast-top-right"]);
        } catch (Exception $e) {
            Toastr::info('Faild!', 'Registration', ["positionClass" => "toast-top-right"]);
        }
        return redirect()->back();
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Formation  $formation
     * @return \Illuminate\Http\Response
     */
    public function editTrainning($id)
    {
        $trainning = Trainning::find($id);

        return view('BackOffice.create.index', compact($trainning));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Formation  $formation
     * @return \Illuminate\Http\Response
     */
    public function  UpdateTrainning(Request $request, $id)
    {


        $validatedData = $request->validate([

            'title' => 'required|unique:trainnings',
            'amount' =>  Rule::requiredIf($request->amount === ($request->first_slice + $request->second_slice + $request->third_slice)),
            'first_slice' => 'required',
            'second_slice' => 'required',
            'third_slice' => 'required',
            'duration' => 'required',
            'short_description' => 'required',


        ]);

        try {
            $data = Trainning::find($id);
            $data->title = $request->title;
            $data->duration = $request->duration;
            $data->amount = $request->amount;
            $data->first_slice = $request->first_slice;
            $data->second_slice = $request->second_slice;
            $data->third_slice = $request->third_slice;
            $data->short_description = $request->short_description;
            $data->long_description = $request->long_description;

            if ($request->file('image')) {
                $file = $request->file('image');
                @unlink(public_path('upload/user_images/' . $data->image));
                $filename = date('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('upload/user_images'), $filename);
                $data->formation_photo_path = $filename;
            }

            $data->update();
            Toastr::success('Successfully !!!', 'Modification', ["positionClass" => "toast-top-right"]);
        } catch (Exception $e) {
            Toastr::info('Failed!', 'Modification', ["positionClass" => "toast-top-right"]);
        }

        return redirect()->route('trainning.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Formation  $formation
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        try {

            $trainning = Trainning::find($id);
            $trainning->delete();
            Toastr::success("Successfully !!!", "Deletion", ["positionClass" => "toast-top-right"]);
        } catch (Exception $e) {
            Toastr::info("Failed!", "Deletion", ["positionClass" => "toast-top-right"]);
        }

        return back();
    }
}
