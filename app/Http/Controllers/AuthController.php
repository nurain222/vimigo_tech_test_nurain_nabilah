<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request){
        
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        $cred = $request->all();
        $cred['password'] = Hash::make($cred['password']);
        $staff = User::create($cred);

        $response['token'] = $staff->createToken('VimigoTech');
        $response['name'] = $staff->name;

        return response()->json($response, 200);
    }

    public function login(Request $request)
    {
        $login = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($login)){
            return  response()->json(['message'=>'Invalid credentials!'], 401);
        }

        $staff = Auth::user();

        $response['token'] = $staff->createToken('VimigoTech');
        $response['name'] = $staff->name;

        return response()->json($response, 200);

    }


}
