<?php

namespace Database\Seeders;

use App\Models\Information;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
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
        // DB::table('admins')->insert([
        //     'name' => Str::random(10),
        //     'email' => 'admin@coder71.com',
        //     'password' => Hash::make('password'),
        // ]);
        // Information::factory(10)->create();
    }
}

