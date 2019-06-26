<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Transformers\UserTransformer;
use Illuminate\Support\Facades\Hash;
use Auth;

class AuthController extends Controller
{
    //
    public function login(){

    }

    public function register(Request $request, User $user){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        

        $users = $user->create([
            'name' => $request->name,
            'email' => $request->email,
            'api_token' => bcrypt($request->email),
            'password' => bcrypt($request->password)
        ]);

        $res = fractal()
            ->item($users)
            ->transformWith(new UserTransformer)
            ->addMeta(['token' => $users->api_token])
            ->toArray();
        
        return response()->json($res, 201);
    }

}
