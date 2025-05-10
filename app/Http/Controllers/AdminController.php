<?php

namespace App\Http\Controllers;

use App\Models\Proizvod;
use App\Models\Narudzbina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * 
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        $brojProizvoda = Proizvod::count();
        $brojNarudzbina = Narudzbina::count();
        $mesecniPrihod = 5000;
        $narudzbinePoDanima = Narudzbina::selectRaw('DATE(created_at) as dan, count(*) as broj') -> groupBy('dan') -> get();

        if (!$user || !in_array($user->role, ['admin', 'editor'])) {
            abort(403, 'Access denied');
        }

        return view('admin.dashboard', compact('brojProizvoda', 'brojNarudzbina', 'mesecniPrihod', 'narudzbinePoDanima'));
    }

    public function showProducts()
    {
        $proizvodi = Proizvod::all();
        return view('admin.proizvodi', compact('proizvodi'));
    }

    public function manageUsers()
    {
        $korisnici = User::all();
        return view('admin.korisnici', compact('korisnici'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
}
