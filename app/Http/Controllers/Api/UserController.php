<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function user()
    {
        Debugbar::log(Auth::user());
        return Auth::user();
    }

    public function changeName(Request $request)
    {
        Auth::user()->update(['name' => $request['name']]);

        return response()->json(['name' => $request['name']]);
    }
    
}
