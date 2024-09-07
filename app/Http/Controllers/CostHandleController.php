<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Investment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CostHandleController extends Controller
{
    public function storeData(Request $request){
        $request->validate([
            'liablity'=>'required|string|min:3',
            'cost'=>'required|numeric',
        ]);

        Investment::create([
            'user_id'=>Auth::user()->id,
            'liablity'=>$request->liablity,
            'cost'=>$request->cost
        ]);
        return redirect()->back()->with('success', 'Investment Created!');

    }
    public function index(Request $request){
        $userId = Auth::user()->id;
        $selectedate = '14/11/2024';
        if($request->query('date')){
            $date = explode('/', $request->query('date'));
            $currentdate = $date[2].'-'.$date[1].'-'.$date[0];
            $selectedate = $request->query('date');
        }else{
            $currentdate = Carbon::now();
        }
        // return $selectedate;
        $date = explode('-', Carbon::parse($currentdate)->format('Y-m-d'));
        $datesting = $date[0].$date[1];

        // return $date;
        $investment = Investment::where('user_id', $userId)->get();
        $investment = $investment->filter(function ($item, $key) use($datesting) {
            return $item->created_at == $datesting;
        });

        $toalamount = 0;
        foreach ($investment as $key => $value) {
            $toalamount += $value->cost;
        }
        return view('index', ['investments'=>$investment, 'toalamount'=>$toalamount, 'selectedate'=>$selectedate]);
    }


    public function edit(Request $request){
        // $id = $request->query('id');
        // $liablity = $request->query('liablity');
        // $cost = $request->query('cost');
        $id = $request->id;
        $liablity = $request->liablity;
        $cost = $request->cost;
        
        $investment = Investment::find($id);
        $investment->liablity = $liablity;
        $investment->cost = $cost;
        $investment->save();
        return redirect()->back()->with('success', 'Updated Successfully!');
    }

    public function delete(Request $request){
        $request->validate([
            'id'=>'required',
        ]);
        $id = $request->id;
        $investment = Investment::find($id);
        $investment->delete();
        return redirect()->back()->with('success', 'Deleted Successfully!');
    }

    // public function filterbydate(Request $request){
    //     $userId = Auth::user()->id;
    //     $currentdate = $request->query('date');
    //     return $request;
    //     $date = explode('/', $request->date);
    //     $datesting = $date[2].$date[1];

    //     $investment = Investment::where('user_id', $userId)->get();
    //     $investment = $investment->filter(function ($item, $key) use($datesting) {
    //         return $item->created_at == $datesting;
    //     });
    //     // return response()->json([
    //     //     'investments'=>$investment,
    //     //     'date'=>$request->date
    //     // ]);
    //     $toalamount = 0;
    //     foreach ($investment as $key => $value) {
    //         $toalamount += $value->cost;
    //     }
    //     return view('index', ['investments'=>$investment, 'toalamount'=>$toalamount, 'selecteddate'=>$currentdate]);
    // }
}

