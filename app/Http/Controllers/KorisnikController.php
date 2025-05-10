<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class KorisnikController extends Controller
{
    public function index()
    {
        $korisnici = User::all();
        return view('admin.korisnici', compact('korisnici'));
    }

    public function create()
    {
        return view('korisnici.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('admin.korisnici')->with('success', 'Korisnik dodat.');
    }

    public function edit($id)
    {
        $korisnik = User::findOrFail($id);
        return view('korisnici.edit', compact('korisnik'));
    }

    public function update(Request $request, $id)
    {
        $korisnik = User::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $korisnik->id,
        ]);

        $korisnik->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($request->password) {
            $korisnik->update(['password' => bcrypt($request->password)]);
        }

        return redirect()->route('admin.korisnici')->with('success', 'Korisnik ažuriran.');
    }

    public function obrisi($id)
    {
        $korisnik = User::findOrFail($id);

        $korisnik->delete();
        
        return redirect()->route('admin.korisnici')->with('success', 'Korisnik obrisan.');
    }
}
