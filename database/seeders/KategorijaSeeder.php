<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Kategorija;

class KategorijaSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Kategorija::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Kategorija::create(['naziv' => 'Muska odeca']);
        Kategorija::create(['naziv' => 'Zenska odeca']);
        Kategorija::create(['naziv' => 'Sportska odeca']);
        Kategorija::create(['naziv' => 'Obuca']);
        Kategorija::create(['naziv' => 'Aksesoari']);
    }
}

