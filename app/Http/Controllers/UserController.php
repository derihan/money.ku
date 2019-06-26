<?php

namespace App\Http\Controllers;

use App\Income;
use App\Expense;
use App\User;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    //
    public function profile(User $user){
        $user = $user->find(Auth::user()->id);

        $response =  fractal()
            ->item($user)
            ->transformWith(new UserTransformer)
            ->includeIncomes()
            ->includeExpenses()
            ->toArray();
        return response()->json($response, 200);
    }
}
