<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'nama' => 'Administrator',
            'nik' => '123',
            'email' => 'admin@gmail.com',
            'password' => '$2y$12$zQ.ggoQS3tddu1mb.Pa9u.bKdXkH0FgZt56bhealcAEFlGto.i/Nq',
            'role' => 'admin',
        ]);

        User::create([
            'nama' => 'Manager',
            'nik' => '1234',
            'email' => 'manager@gmail.com',
            'password' => '$2y$12$zQ.ggoQS3tddu1mb.Pa9u.bKdXkH0FgZt56bhealcAEFlGto.i/Nq',
            'role' => 'manager',
        ]);

        User::create([
            'nama' => 'User',
            'nik' => '12345',
            'email' => 'user@gmail.com',
            'password' => '$2y$12$zQ.ggoQS3tddu1mb.Pa9u.bKdXkH0FgZt56bhealcAEFlGto.i/Nq',
            'role' => 'masyarakat',
        ]);

        

        $this->call([
            AduanSeeder::class,
        ]);
    }
}