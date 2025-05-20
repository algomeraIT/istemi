<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaxRatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tax_rates')->insert([
            [
                'name'   => '10%',
                'rate'   => 10.00,
                'active' => true,
            ],
            [
                'name'   => '22%',
                'rate'   => 22.00,
                'active' => true,
            ],
        ]);
    }
}
