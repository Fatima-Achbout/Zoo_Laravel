<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('tickets')->insert([
            ['type' => 'Adulte', 'price' => 70],
            ['type' => 'Enfant', 'price' => 50],
            ['type' => 'VIP', 'price' => 100],
        ]);
    }
}