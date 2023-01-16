<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Office;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Админ',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
        ]);
        Office::create([
            'name' => "",
            'inn' => "000000000",
            'bank_account' => "00000000000000000000",
            'bank_code' => "00000",
            'leader' => "",
            'accountant' => "",
        ]);
    }
}
