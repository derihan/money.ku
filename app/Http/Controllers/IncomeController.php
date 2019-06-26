<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Income;
use Auth;
use App\Transformers\IncomeTransformer;

class IncomeController extends Controller
{
    //

    
    public function show(){
        $id = Auth::user()->id;
        $data = Income::where('user_id','=',$id)->get();

        $response = fractal()
            ->collection($data)
            ->transformWith(new IncomeTransformer)
            ->toArray();

        return response()->json($response, 200);
    }

    public function add(Request $request, Income $income){
        $this->validate($request,[
            'judul' => 'required|min:3',
            'jumlah' => 'required|min:4'
        ]);

        $incomes = $income->create([
            'user_id' => Auth::user()->id,
            'i_judul' => $request->judul,
            'i_description' => $request->description,
            'i_jumlah' => $request->jumlah
        ]);

        $response = fractal()
            ->item($incomes)
            ->transformWith(new IncomeTransformer)
            ->toArray();
        
        // return $request->all();
        return response()->json($response, 201);
    }
}
