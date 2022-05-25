<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name' => 'Admin',
                'email' => 'adminuser@gmail.com',
                'password' => Hash::make('123456'),
                'role' => 1,
            ],
            [
                'name' => 'User1',
                'email' => 'user1@gmail.com',
                'password' => Hash::make('123456'),
                'role' => 2,
            ],
            [
                'name' => 'User2',
                'email' => 'user2@gmail.com',
                'password' => Hash::make('123456'),
                'role' => 2,
            ]
        ];
        User::insert($user);
    }
}
