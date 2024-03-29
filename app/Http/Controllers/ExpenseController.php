<?php

namespace App\Http\Controllers;

use App\Expense;
use Auth;
use Illuminate\Http\Request;
use App\Transformers\ExpenseTransformer;

class ExpenseController extends Controller
{
    //
    public function add(Request $request,Expense $expense){
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

    public function show(){
        $id = Auth::user()->id;
        $data = Expense::where('user_id','=',$id)->get();

        return response()->json([
            'title' => 'Data Expense',
            'method' => 'GET',
            'author'=>Auth::user()->email,
            'id author'=>$id,
            'count'=>$data->count(),
            'exp' => $data], 200);
    }

    public function showByid($expense){

        $data = Income::where([['user_id','=',Auth::user()->id],['id','=',$expense]])->first();

        return response()->json($data, 200);

    }

    public function update(Request $request,Expense $expense)
    {
        $this->authorize('update',$expense);

        $expense->e_judul = $request->get('judul', $expense->e_judul);
        $expense->e_description = $request->get('description', $expense->e_description);
        $expense->e_jumlah = $request->get('jumlah', $expense->e_jumlah);
        $expense->save();
        
        $response = array(
            'status' => 'edit data sukses'
        );
        
        return response()->json($response, 200);
    }

    public function delete(Expense $expense)
    {
        $this->authorize('delete',$expense);

        $id_data = $expense->id;

        $expense->delete();

        return response()->json(['message' => 'data id '.$id_data.' has been deleted '], 200);
    }

}
