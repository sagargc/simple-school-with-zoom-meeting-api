<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        
        // User
        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'status' => 1,
            'password' => Hash::make('password'),
        ]);
        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => 'teacher@gmail.com',
            'role' => 'teacher',
            'status' => 1,
            'password' => Hash::make('password'),
        ]);
        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => 'student@gmail.com',
            // 'email' => Str::random(10).'@gmail.com',
            'role' => 'student',
            'status' => 1,
            'password' => Hash::make('password'),
        ]);

    
    }
}
