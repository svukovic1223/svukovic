<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected function authenticated(Request $request, $user)
    {
        if ($user->hasRole('admin') || $user->hasRole('editor')) {
            return redirect()->route('admin.index');
        }

        return redirect()->route('profile');
    }
}
