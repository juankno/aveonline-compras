<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
            'name' => 'Administrator User',
            'email' => 'admin@example.com',
            'email_verified_at' =>  now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'role_id' => User::ROLES['admin'],
        ]);

        User::create([
            'name' => 'Common User',
            'email' => 'user@example.com',
            'email_verified_at' =>  now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'role_id' => User::ROLES['user'],
        ]);

        User::create([
            'name' => 'Customer User',
            'email' => 'customer@example.com',
            'email_verified_at' =>  now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'role_id' => User::ROLES['customer'],
        ]);

        factory(User::class, 10)->create();
    }
}
