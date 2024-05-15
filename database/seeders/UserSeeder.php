<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'id' => '1',
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'role' => 'admin',
        ]);

        User::create([
            'id' => '2',
            'name' => 'Orang',
            'email' => 'orang@gmail.com',
            'password' => bcrypt('orang'),
            'role' => 'user',
        ]);

        User::create([
            'id' => '3',
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => bcrypt('user'),
            'role' => 'user',
        ]);

        User::factory()->count(3)->create();
    }
}
