<?php

namespace App\Http\Controllers;

use App\Models\Kategorija;
use App\Models\Proizvod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProizvodController extends Controller
{
    public function istaknuti()
    {
        $proizvodi = Proizvod::where('istaknuto', true)->get();
        return view('pocetna', compact('proizvodi'));
    }

    public function index()
    {
        $proizvodi = Proizvod::all();
        return view('katalog', compact('proizvodi'));
    }

    public function show(Proizvod $proizvod)
    {
        return view('proizvod', compact('proizvod'));
    }

    public function adminIndex()
    {
        $proizvodi = Proizvod::all();
        return view('admin.proizvodi', compact('proizvodi'));
    }

    public function edit($id)
    {
        $proizvod = Proizvod::findOrFail($id);
        $kategorije = Kategorija::all();
        

        return view('proizvodi.edit', compact('proizvod', 'kategorije'));
    }

    public function destroy($id)
    {
        $proizvod = Proizvod::findOrFail($id);
        
        $proizvod->delete();

        return redirect()->route('admin.proizvodi')->with('success', 'Proizvod je obrisan.');
    }

    public function create()
    {
        $kategorije = Kategorija::all();
        return view('proizvodi.create', compact('kategorije'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'naziv' => 'required|string|max:255',
            'opis' => 'nullable|string',
            'cena' => 'required|numeric',
            'kategorija_id' => 'required|exists:kategorijas,id',
            'slika' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('slika') && $request->file('slika')->isValid()) {
            $slikaPath = $request->file('slika')->store('proizvodi', 'public');
        }

        $proizvod = new Proizvod();
        $proizvod->naziv = $request->naziv;
        $proizvod->opis = $request->opis;
        $proizvod->cena = $request->cena;
        $proizvod->kategorija_id = $request->kategorija_id;
        $proizvod->istaknuto = $request->has('istaknuto');
        $proizvod->slika = $slikaPath ?? null;
        $proizvod->save();

        return redirect()->route('admin.proizvodi')->with('success', 'Proizvod uspešno dodat.');
    }

    public function update(Request $request, $id)
    {
        $proizvod = Proizvod::findOrFail($id);

        $request->validate([
            'naziv' => 'required|string|max:255',
            'opis' => 'nullable|string',
            'cena' => 'required|numeric',
            'kategorija_id' => 'required|exists:kategorijas,id',
            'slika' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $proizvod->naziv = $request->input('naziv');
        $proizvod->opis = $request->input('opis');
        $proizvod->cena = $request->input('cena');
        $proizvod->istaknuto = $request->has('istaknuto') ? 1 : 0;
        $proizvod->kategorija_id = $request->input('kategorija_id');

        if ($request->hasFile('slika') && $request->file('slika')->isValid()) {
            if ($proizvod->slika) {
                Storage::disk('public')->delete($proizvod->slika);
            }

            $slikaPath = $request->file('slika')->store('proizvodi', 'public');
            $proizvod->slika = $slikaPath;
        }

        $proizvod->save();

        return redirect()->route('admin.proizvodi')->with('success', 'Proizvod uspešno izmenjen.');
    }


}
