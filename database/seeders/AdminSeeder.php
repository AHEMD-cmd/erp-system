<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'admin',
            'username' => 'adminUser',
            'email' => 'admin@gmail.com.com',
            'password' => Hash::make('asdasdas'), 
            'company_code' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
