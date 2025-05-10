<?php

namespace App\Http\Controllers;

use App\Models\Narudzbina;
use App\Models\Proizvod;
use Illuminate\Http\Request;

class NarudzbinaController extends Controller
{
    public function index()
    {
        $narudzbine = Narudzbina::all();
        return view('narudzbine.index', compact('narudzbine'));
    }


    public function show($id)
    {
        $narudzbina = Narudzbina::findOrFail($id);
        return view('narudzbine.show', compact('narudzbina'));
    }

    public function create()
    {
        $proizvodi = Proizvod::all();
        return view('narudzbine.create', compact('proizvodi'));
    }

    public function store(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Morate biti prijavljeni da biste napravili narudžbinu.');
        }

        $request->validate([
            'ime' => 'required|string|max:255',
            'proizvod_id' => 'required|exists:proizvodi,id',
            'kolicina' => 'required|integer|min:1',
            'adresa' => 'required|string|max:255',
        ]);

        Narudzbina::create([
            'ime' => $request->ime,
            'email' => auth()->user()->email,
            'proizvod_id' => $request->proizvod_id,
            'kolicina' => $request->kolicina,
            'adresa' => $request->adresa,
            'status' => 'obrađuje se',
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('profil')->with('success', 'Narudžbina je uspešno kreirana!');
    }

    public function edit($id)
    {
        $narudzbina = Narudzbina::findOrFail($id);
        $proizvodi = Proizvod::all();

        return view('narudzbine.edit', compact('narudzbina', 'proizvodi'));
    }

    public function update(Request $request, $id)
    {
        $narudzbina = Narudzbina::findOrFail($id);

        $request->validate([
            'proizvod_id' => 'required|exists:proizvodi,id',
            'kolicina' => 'required|integer|min:1',
            'adresa' => 'required|string|max:255',
            'status' => 'nullable|string',
        ]);

        $narudzbina->proizvod_id = $request->input('proizvod_id');
        $narudzbina->kolicina = $request->input('kolicina');
        $narudzbina->adresa = $request->input('adresa');
        $narudzbina->status = $request->input('status', $narudzbina->status);

        $narudzbina->save();

        return redirect()->route('profil')->with('success', 'Narudžbina uspešno ažurirana.');
    }

    public function destroy($id)
    {
        $narudzbina = Narudzbina::findOrFail($id);
        $narudzbina->delete();

        return redirect()->route('profil')->with('success', 'Narudžbina je uspešno obrisana!');
    }

    public function adminIndex()
    {
        $narudzbine = Narudzbina::all(); 

        return view('admin.narudzbine', ['narudzbina' => $narudzbine]);
    }

    public function dodaj()
    {
        $proizvodi = Proizvod::all();
        return view('narudzbine.dodaj', compact('proizvodi'));
    }

    public function dodato(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Morate biti prijavljeni da biste napravili narudžbinu.');
        }

        $request->validate([
            'ime' => 'required|string|max:255',
            'proizvod_id' => 'required|exists:proizvodi,id',
            'kolicina' => 'required|integer|min:1',
            'adresa' => 'required|string|max:255',
        ]);

        Narudzbina::create([
            'ime' => $request->ime,
            'email' => auth()->user()->email,
            'proizvod_id' => $request->proizvod_id,
            'kolicina' => $request->kolicina,
            'adresa' => $request->adresa,
            'status' => 'obrađuje se',
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('admin.narudzbine')->with('success', 'Narudžbina je uspešno kreirana!');
    }

    public function obrisi($id)
    {
        $narudzbina = Narudzbina::findOrFail($id);
        $narudzbina->delete();

        return redirect()->route('admin.narudzbine')->with('success', 'Narudžbina je uspešno obrisana!');
    }

    public function izmeni($id)
    {
        $narudzbina = Narudzbina::findOrFail($id);
        $proizvodi = Proizvod::all();

        return view('narudzbine.izmeni', compact('narudzbina', 'proizvodi'));
    }

    public function azuriraj(Request $request, $id)
    {
        $narudzbina = Narudzbina::findOrFail($id);

        $request->validate([
            'proizvod_id' => 'required|exists:proizvodi,id',
            'kolicina' => 'required|integer|min:1',
            'adresa' => 'required|string|max:255',
            'status' => 'nullable|string',
        ]);

        $narudzbina->proizvod_id = $request->input('proizvod_id');
        $narudzbina->kolicina = $request->input('kolicina');
        $narudzbina->adresa = $request->input('adresa');
        $narudzbina->status = $request->input('status', $narudzbina->status);

        $narudzbina->save();

        return redirect()->route('admin.narudzbine')->with('success', 'Narudžbina uspešno ažurirana.');
    }
}
