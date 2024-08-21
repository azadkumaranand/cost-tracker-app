<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Investment;

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
    public function edit(){

    }
    public function update(){

    }
}

