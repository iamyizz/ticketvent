<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'iamyizz',
            'email' => 'yizzofficial@gmail.com',
            'usertype' => 'admin',
            'no_hp' => '08881930665',
            'alamat' => 'Kaliaren',
            'password' => Hash::make('hahahA_#123'),
        ]);

        User::create([
            'name' => 'cryoion',
            'email' => 'lalala@gmail.com',
            'usertype' => 'user',
            'no_hp' => '081234567891',
            'alamat' => 'bengkulu',
            'password' => Hash::make('lalala666'),
        ]);
    }
}
