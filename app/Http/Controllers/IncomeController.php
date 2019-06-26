<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Income;
use Auth;
use App\Transformers\IncomeTransformer;

class IncomeController extends Controller
{
    //
    public function update(Request $request,Income $income){
        $this->authorize('update', $income);

        $income->i_judul = $request->get('judul',$income->i_judul);
        $income->i_description = $request->get('description',$income->i_description);
        $income->i_jumlah = $request->get('jumlah',$income->i_jumlah);
        $income->save();

        $response = fractal()
                ->item($income)
                ->transformWith(new IncomeTransformer)
                ->toArray();
        
        // return $income->user_id;

        return response()->json($response, 200);
    }

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
            'jumlah' => 'required|min:4|numeric'
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
