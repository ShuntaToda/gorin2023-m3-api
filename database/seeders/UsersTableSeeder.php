<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['name' => 'gorin', 'password' => '2023'],
            ['name' => 'gorin2', 'password' => '2023'],
            ['name' => 'gorin3', 'password' => '2023'],
        ];

        foreach ($users as $user) {
            User::create([
                'name' => $user['name'],
                'email' => $user['name'] . '@example.com', // メールアドレスも必要な場合
                'password' => Hash::make($user['password']),
            ]);
        }
    }
}
