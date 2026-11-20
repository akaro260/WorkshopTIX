<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrNew([
            'email' => 'admin@workshoptix.test',
        ]);

        $admin->name = 'WorkshopTIX Admin';
        $admin->password = Hash::make('Admin123!');
        $admin->forceFill([
            'role' => 'admin',
        ]);

        $admin->save();
    }
}
