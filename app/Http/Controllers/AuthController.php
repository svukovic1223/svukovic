<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function notAuth() {
        return view('auth.not-auth');
    }

    public function login() {
        return view("auth.login");
    }

    public function storeLogin(Request $request) {
        if (empty($request->email) or empty($request->password)) {
            return redirect()->route("login")->with("error", "Morate da popunite sva polja!");
        }

        if (Auth::attempt($request->only("email", "password"))) {
            $user = Auth::user();
    
            if ($user->role === 'registered') {
                return redirect()->route('profil');
            } elseif (in_array($user->role, ['admin', 'editor'])) {
                return redirect()->route('admin.dashboard');
            }
    
            return redirect()->route('pocetna');
        }

        return redirect()->route("login")->with("error", "Nepostojeci podaci za logovanje.");
    }

    public function logout() {
        Auth::logout();
        return redirect()->route("pocetna");
    }

    public function register() {
        return view("auth.register");
    }

    public function storeRegister(Request $request) {
        $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users",
            "password" => "required|min:6",
        ]);

        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "role" => 'registered',
        ]);

        return redirect()->route("login")->with("success", "Registracija je prosla uspesno! Sada se ulogujte!");
    }
}
