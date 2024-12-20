<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
        //Str::random(10)
        DB::table('users')->insert([
            'name' => 'Morgan',
            'email' => 'jichiduo@163.com',
            'password' => Hash::make('12345'),
            'role' => 'admin',
            'division_id' => 1,
            'division_name' => 'Centre Shop',
            'group_id' => 1,
            'group_name' => 'Main Group',
        ]);
    }
}
