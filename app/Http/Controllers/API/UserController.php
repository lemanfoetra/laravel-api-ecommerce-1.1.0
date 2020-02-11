<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:api')->except('login','register');
    }
    


    public function index()
    {
        return "ok, It Work.";
    }



    public function login(){
        if(Auth::attempt([
                'email' => request('email'), 
                'password' => request('password')
            ])){

            $user = Auth::user();
            $success['token'] =  $user->createToken('eapi')->accessToken;

            return response()->json(['success' => $success], 200);
        }
        else{
            return response()->json(['error'=>'User Tidak Terdaftar'], 401);
        }
    }


    

    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], 200);
    }
}
