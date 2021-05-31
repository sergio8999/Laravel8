<?php

namespace App\Http\Controllers;

use App\Http\Requests\Login;
use App\Http\Requests\SignUp;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function index(){
        return view('register.index');
    }

    public function signUp(SignUp $request)
    {
        /* $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string'
        ]); */

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }

    public function login(Login $request)
    {
        /* $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]); */

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ]);

        
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');

        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($token->expires_at)->toDateTimeString()
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
