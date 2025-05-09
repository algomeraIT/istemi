<?php

namespace Database\Seeders;

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
            UserTableSeeder::class,
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
            // LeadSeeder::class,
            NoteCommunicationClientHistorySeeder::class,
            NoteCommunicationClientSeeder::class,
            NoteSeeder::class,
            PhaseSeeder::class,
            ProjectSeeder::class,
            ReferentSeeder::class,
            SaleSeeder::class,
            // ContactSeeder::class,
            UserTableSeeder::class,
            NoteProjectSeeder::class,
            ContactSeeder::class,
            HistoryContactsTableSeeder::class,
            ProjectStartSeeder::class,
            TaskProjectStartSeeder::class,
            DocumentProjectSeeder::class,
        ]);
    }
}
