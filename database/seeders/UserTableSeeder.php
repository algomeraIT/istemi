<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'last_name' => 'Lastname',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'has_to_change_password' => false,
            'image_path' => null,
            'cellphone' => null,
            'address' => null,
            'city' => null,
            'province' => null,
            'cap' => null,
            'role' => 'admin',
            'job_position' => 'Fullstack Developer',
            'status' => 1, //1 == active, 0 == disable
            'created_at' => now(),
            'updated_at' => now(),
            'remember_me' => 0,
        ]);
  
        User::factory()->count(30)->create();
    }
}
