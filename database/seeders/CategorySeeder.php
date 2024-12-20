<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('categories')->insert([
            'name' => 'Fix Asset'
        ]);
        DB::table('categories')->insert([
            'name' => 'Laundry'
        ]);
        DB::table('categories')->insert([
            'name' => 'Payment'
        ]);
        DB::table('categories')->insert([
            'name' => 'Others'
        ]);
    }
}
