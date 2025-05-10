<?php

namespace Database\Seeders;

use App\Models\Narudzbina;
use App\Models\Proizvod;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NarudzbinaSeeder extends Seeder
{
    public function run(): void
    {
        $proizvodi = Proizvod::all();
        $users = User::all();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Narudzbina::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        if ($users->isEmpty()) {
            $user = User::create([
                'name' => 'Test Korisnik',
                'email' => 'test@korisnik.com',
                'password' => bcrypt('password123'),
            ]);
        } else {
            $user = $users->random();
        }

        foreach (range(1, 5) as $i) {
            Narudzbina::create([
                'ime' => "Kupac $i",
                'email' => "kupac$i@example.com",
                'proizvod_id' => $proizvodi->random()->id,
                'kolicina' => rand(1, 3),
                'adresa' => "Adresa br. $i",
                'user_id' => $user->id,
                'status' => 'obrađuje se',
            ]);
        }
    }
}
