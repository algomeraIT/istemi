<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AccountingInvoiceSeeder::class,
            AccountingOrderSeeder::class,
            AcquisitionSeeder::class,
            ActivityCommunicationClientHistorySeeder::class,
            ArchiveSeeder::class,
            AttachSeeder::class,
            ClientsSeeder::class,
            CommunicationSeeder::class,
            EmailCommunicationClientHistorySeeder::class,
            EstimateSeeder::class,
            HistorySeeder::class,
            LeadSeeder::class,
            NoteCommunicationClientHistorySeeder::class,
            NoteCommunicationClientSeeder::class,
            NoteProjectSeeder::class,
            NoteSeeder::class,
            PhaseSeeder::class,
            ProjectSeeder::class,
            ReferentSeeder::class,
            SaleSeeder::class,
            UsersTableSeeder::class,
            ContactSeeder::class,
        ]);
    }
}
