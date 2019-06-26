<?php

namespace App\Http\Controllers;

use App\Expense;
use Auth;
use Illuminate\Http\Request;
use App\Transformers\ExpenseTransformer;

class ExpenseController extends Controller
{
    //
    public function add(Request $request, Expense $expense){
        $this->validate($request,[
            'judul' => 'required|min:3',
            'jumlah' => 'required|min:4|numeric'
        ]);

        $expense = $expense->create([
            'user_id' => Auth::user()->id,
            'e_judul' => $request->judul,
            'e_description' => $request->description,
            'e_jumlah' => $request->jumlah
        ]);

        $response = fractal()
            ->item($expense)
            ->transformWith(new ExpenseTransformer)
            ->toArray();
        // return $request->all();
        return response()->json($response, 201);
    }    

}
