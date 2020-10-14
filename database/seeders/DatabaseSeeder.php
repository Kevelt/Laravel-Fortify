<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'user' => 'superadmin',
                'password' => Hash::make('superadmin'),
                'rol' => 1,
            ],
            [
                'user' => 'userspain',
                'password' => Hash::make('userspain'),
                'rol' => 2,
            ],
            [
                'user' => 'userfrance',
                'password' => Hash::make('userfrance'),
                'rol' => 2,
            ],
        ]);
    }
}
