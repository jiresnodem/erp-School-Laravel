<?php

namespace App\Http\Controllers\BackOffice;

use Exception;
use App\Models\Slice;
use App\Models\Trainning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SliceController extends Model
{
    use HasFactory;

    // public function index(Request $request)
    // {

    //     $slices = Trainning::all();
    //     if ($request->wantsJson()) {
    //         return response()->json(["trainning_list" => $slices]);
    //     }
    //     return view("trainning.index", compact('slices'));
    // }

    public function choiceTrainnig()
    {
        $trainnings = Trainning::all();
        return view("BackOffice.slice.choiceTraining", compact("trainnings"));
    }

    public function create(Request $request)
    {
        $totalSlice = DB::table("slices")->where('trainning_id', '=', $request->training_id)->sum('price');
        $trainning = Trainning::find($request->training_id);
        $remainingAmount = $trainning->amount - $totalSlice;

        return view("BackOffice.slice.create", compact("remainingAmount", "trainning", 'totalSlice'));
    }


    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required | numeric',
            'trainning_id' => 'required',
        ]);

        if ($validator->fails()) {
            Toastr::error('Veillez verifier tous les champs', 'Verify', ["positionClass" => "toast-top-right"]);
            return back()->withErrors([
                'price' => 'The amount cannot be null or equal to zero',
                'name' => 'The name cannot be null'
            ]);
        }
        try {

            if ($request->price == 0 || $request->price < 0) {

                Toastr::info('', 'Verify', ["positionClass" => "toast-top-center"]);
                return back()->withErrors([
                    'price' => 'The amount cannot be null or equal to zero',
                    'name' => 'The name cannot be null'
                ]);
            }

            $trainning = Trainning::find($request->trainning_id);
            $slices = Slice::all()->where('trainning_id', '=', $request->trainning_id)->count();

            if ($trainning == null) {

                return back();
            }

            if ($slices == 0) {
                try {

                    if ($trainning->amount > $request->price) {

                        $tran = new Slice();
                        $tran->name = $request->name;
                        $tran->price = $request->price;
                        $tran->trainning_id = $request->trainning_id;
                        $tran->save();
                        Toastr::success('Successfully !!!', 'Registration', ["positionClass" => "toast-top-right"]);
                        return back();
                    } else {
                        Toastr::info('', 'Verify', ["positionClass" => "toast-top-right"]);
                        return back()->withErrors([
                            'price' => 'The amount between cannot be greater than the amount of training
                            ',
                        ]);
                    }
                } catch (Exception $ex) {

                    Toastr::error('Failed !!!', 'Registration', ["positionClass" => "toast-top-right"]);
                    return back();
                }
            } else {
                $total = DB::table("slices")->where('trainning_id', '=', $request->trainning_id)->sum('price');
                $resetPay = $trainning->amount - $total;

                if ($resetPay >= $request->price) {
                    $tranche = new Slice();
                    $tranche->name = $request->name;
                    $tranche->price = $request->price;
                    $tranche->trainning_id = $request->trainning_id;
                    $tranche->save();
                    Toastr::success('Successfully !!!', 'Registration', ["positionClass" => "toast-top-right"]);
                    return back();
                } else {
                    return back()->withErrors(['price' => 'The amount between exceeds the remaining amount']);
                }
            }

        } catch (Exception $ex) {
            Toastr::error('an error occured', '', ["positionClass" => "toast-top-right"]);
        }
    }


    public function edit(Request $request, $id)
{
        $total_slices = Slice::all()->where('trainning_id', '=', $request->trainning_id)->sum('price');
        $trainning = Trainning::find($id);
   
        $slice = Slice::find($id);
        $trainning_id = $request->trainning_id;

        if ($slice != null) {
            return view("BackOffice.slice.edit", compact("slice", 'trainning_id'));
        }
        return back();
    }

    public function sliceUpdate(Request $request, $id)
    {
        $trainning = Trainning::find($request->trainning_id);
        try {
            if ($request->price == 0 || $request->price < 0) {

                Toastr::info('', 'Verify', ["positionClass" => "toast-top-center"]);
                return back()->withErrors([
                    'price' => 'The amount cannot be null or equal to zero',
                    'name' => 'The name cannot be null'
                ]);
            }

            if ($trainning->amount > $request->price) {
                $slice = Slice::find($id);
                $slice->name = $request->name;
                $slice->price = $request->price;
                $slice->save();
                Toastr::success('Successfully !!!', 'Modification', ["positionClass" => "toast-top-right"]);
                return redirect()->route('return.create', [$request->trainning_id ]);
            }
        } catch (Exception $ex) {
            dd($ex);
            Toastr::error('Failed !!!', 'Modification', ["positionClass" => "toast-top-right"]);
            return back();
        }
    }

    public function returnCreate($trainning_id)
    {
        $totalSlice = DB::table("slices")->where('trainning_id', '=',  $trainning_id)->sum('price');
        $trainning = Trainning::find($trainning_id);
        $remainingAmount = $trainning->amount - $totalSlice;

        return view("BackOffice.slice.create", compact("remainingAmount", "trainning", 'totalSlice'));
    }

    public function deleteSlice($id)
    {
        Slice::find($id)->delete();
        return back();
    }
}
