<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TokenController extends Controller
{
    public function create(Request $request)
    {
        $token = $request->user()->createToken('apiTokenString');
        return $token;
    }
}
