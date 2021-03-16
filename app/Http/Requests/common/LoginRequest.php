<?php

namespace App\Http\Requests\Common;

use App\Http\Requests\AbstractRequest;
use Illuminate\Http\Request;

class LoginRequest extends AbstractRequest
{
    public function __construct(string $functionName, Request $request)
    {
        parent::__construct($functionName, $request);
    }

    public function login()
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string',
        ];
    }

    public function register()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }
}
