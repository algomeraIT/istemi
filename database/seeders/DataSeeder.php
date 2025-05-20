<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Data;


class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Data::factory()->count(10)->create();

        $this->call([
            IssuersSeeder::class,
            GeneralTermsSeeder::class,
            PriceListsSeeder::class,
            TaxRatesTableSeeder::class,
            QuoteTemplatesSeeder::class,
            CategoriesSeeder::class,
            ProductsSeeder::class,
        ]);
    }
}
