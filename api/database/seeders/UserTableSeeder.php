<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("users")-> insert([
            'name' => 'Craig Doe',
            'email' => 'craigdoe@gmail.com',
            'password' => Hash::make('password')
        ]);
    }
}
