<?php

namespace Database\Seeders;

use App\Models\AccountingOrder;
use Illuminate\Database\Seeder;

class AccountingOrderSeeder extends Seeder
{
    public function run(): void
    {
        AccountingOrder::factory()->count(20)->create();
    }
}
