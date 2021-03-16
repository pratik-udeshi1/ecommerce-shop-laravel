<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Common\LoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $this->doValidation(__FUNCTION__, $request);

        $creds = $request->only(['email', 'password']);

        if (!$token = auth()->attempt($creds)) {
            return response()->json(['error' => 'Wrong email or password!'], 401);
        }

        return response()->json(compact('token'));
    }

    public function register(Request $request)
    {
        $this->doValidation(__FUNCTION__, $request);

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Registration failed']);
        }

        return response()->json(['success' => true, 'message' => 'Registration successful']);
    }

    public function doValidation($function, $request)
    {
        (new LoginRequest($function, $request))->validate();
    }
}
