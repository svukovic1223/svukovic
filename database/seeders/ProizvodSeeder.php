<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Proizvod;
use Illuminate\Support\Facades\DB;
use App\Models\Kategorija;

class ProizvodSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Proizvod::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $kategorija1 = Kategorija::where('naziv', 'Muska odeca')->first();
        $kategorija2 = Kategorija::where('naziv', 'Zenska odeca')->first();
        $kategorija3 = Kategorija::where('naziv', 'Sportska odeca')->first();
        $kategorija4 = Kategorija::where('naziv', 'Obuca')->first();
        $kategorija5 = Kategorija::where('naziv', 'Aksesoari')->first();

        Proizvod::create([
            'naziv' => 'Majica',
            'opis' => 'Majica bele boje',
            'cena' => 1000,
            'slika' => null,
            'istaknuto' => true,
            'kategorija_id' => $kategorija1->id,
        ]);

        Proizvod::create([
            'naziv' => 'Trenerka',
            'opis' => 'Udobna i topla trenerka',
            'cena' => 1500,
            'slika' => null,
            'istaknuto' => false,
            'kategorija_id' => $kategorija3->id,
        ]);

        Proizvod::create([
            'naziv' => 'Duks',
            'opis' => 'Muški udobni duks za treniranje',
            'cena' => 2000,
            'slika' => null,
            'istaknuto' => true,
            'kategorija_id' => $kategorija3->id,
        ]);

        Proizvod::create([
            'naziv' => 'Pantalone',
            'opis' => 'Pantalone crne boje',
            'cena' => 2500,
            'slika' => null,
            'istaknuto' => false,
            'kategorija_id' => $kategorija2->id,
        ]);

        Proizvod::create([
            'naziv' => 'Cipele',
            'opis' => 'Cipele crvene boje',
            'cena' => 3000,
            'slika' => null,
            'istaknuto' => true,
            'kategorija_id' => $kategorija4->id,
        ]);

        $this->updateProizvodiWithNewCategories();
    }

    public function updateProizvodiWithNewCategories()
    {
        $kategorije = Kategorija::all();
        
        foreach ($kategorije as $kategorija) {
            DB::table('proizvodi')
                ->where('kategorija_id', $kategorija->id)
                ->update(['kategorija_id' => $kategorija->id]);
        }
    }
}
