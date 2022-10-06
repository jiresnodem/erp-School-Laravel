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

    public function showTrainning($id)
    {
        $trainning = Trainning::find($id);
        return view('BackOffice.trainning.showTrainning', compact('trainning'));
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
            'amount' => 'required',
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

        try {
            if ($request->amount == ($request->first_slice + $request->second_slice + $request->third_slice)) {
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
                    $file->move(public_path('upload/trainning_images'), $filename);
                    $data->trainning_photo_path = $filename;
                    // dd($filename);
                }
            } else {
                return redirect()->back()->withErrors(['amount' => 'The installment sum must be equal to the amount ']);
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

        return view('BackOffice.trainning.create', compact('trainning'));
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

            'title' => 'required',
            'amount' =>  'required',
            'first_slice' => 'required',
            'second_slice' => 'required',
            'third_slice' => 'required',
            'duration' => 'required',
            'short_description' => 'required',


        ]);

        try {
            if ($request->amount == ($request->first_slice + $request->second_slice + $request->third_slice)) {
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
            $filename = date('YmdHi') . '_' . $request->title . '.' . $file->extension();
            $file->move(public_path('upload/trainning_images'), $filename);
            $data->trainning_photo_path = $filename;
        }
    } else {
        return redirect()->back()->withErrors(['amount' => 'The installment sum must be equal to the amount ']);
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
