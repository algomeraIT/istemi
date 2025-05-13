<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AccountingInvoice;

class AccountingInvoiceSeeder extends Seeder
{
    public function run(): void
    {
        AccountingInvoice::factory()->count(20)->create();
    }
}
