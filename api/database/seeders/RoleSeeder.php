<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'admin@test.com'],
            ['name' => 'Admin',     'password' => Hash::make('password'), 'role' => User::ROLE_ADMIN]
        );
        User::updateOrCreate(
            ['email' => 'organizer@test.com'],
            ['name' => 'Organizer', 'password' => Hash::make('password'), 'role' => User::ROLE_ORGANIZER]
        );
        User::updateOrCreate(
            ['email' => 'attendee@test.com'],
            ['name' => 'Attendee',  'password' => Hash::make('password'), 'role' => User::ROLE_ATTENDEE]
        );
    }
}
