<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@pwa.rs',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Editor User',
            'email' => 'editor@pwa.rs',
            'password' => Hash::make('editor'),
            'role' => 'editor',
        ]);

        User::create([
            'name' => 'Regular User',
            'email' => 'user@pwa.rs',
            'password' => Hash::make('user'),
            'role' => 'registered',
        ]);
    }
}
