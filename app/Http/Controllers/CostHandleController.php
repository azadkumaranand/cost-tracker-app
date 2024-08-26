<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Investment;
use Carbon\Carbon;

class CostHandleController extends Controller
{
    public function storeData(Request $request){
        $request->validate([
            'liablity'=>'required|string|min:3',
            'cost'=>'required|numeric',
        ]);

        Investment::create([
            'liablity'=>$request->liablity,
            'cost'=>$request->cost,
        ]);
        return redirect()->back()->with('success', 'Investment Created!');

    }
    public function index(){
        $investment = Investment::all();

        $currentdate = Carbon::now();
        $currentdate = Carbon::parse($currentdate)->format('d/m/Y');
        $currentmonth = explode('/', $currentdate)[1];
        
        $investment = $investment->filter(function ($item, $key) use($currentmonth) {
            $date = explode('/', Carbon::parse($item->created_at)->format('d/m/Y'))[1];
            return $currentmonth == $date;
        });
        $toalamount = 0;
        foreach ($investment as $key => $value) {
            $toalamount += $value->cost;
        }
        return view('index', ['investments'=>$investment, 'toalamount'=>$toalamount]);
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
}

