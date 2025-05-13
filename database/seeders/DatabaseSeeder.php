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
            ClientsSeeder::class,
            ProjectSeeder::class,
            AccountingInvoiceSeeder::class,
            AccountingOrderSeeder::class,
            AcquisitionSeeder::class,
            ActivityCommunicationClientHistorySeeder::class,
            ArchiveSeeder::class,
            AttachSeeder::class,
            CommunicationSeeder::class,
            EmailCommunicationClientHistorySeeder::class,
            EstimateSeeder::class,
            HistorySeeder::class,
            NoteCommunicationClientHistorySeeder::class,
            NoteCommunicationClientSeeder::class,
            NoteSeeder::class,
            PhaseSeeder::class,
            ReferentSeeder::class,
            SaleSeeder::class,
            NoteProjectSeeder::class,
            HistoryContactsTableSeeder::class,
            ProjectStartSeeder::class,
            TaskProjectStartSeeder::class,
            DocumentProjectSeeder::class,
            InvoicesSalSeeder::class,
            ConstructionSitePlaneSeeder::class,
            ActivitySeeder::class,
            DataSeeder::class,
            ReportSeeder::class,
            AccountingSeeder::class,
            ExternalValidationSeeder::class,
            AccountingValidationSeeder::class,
            NonComplianceManagementSeeder::class,
            CloseActivitySeeder::class,
            NoteTaskProjectStartSeeder::class,
            TaskProjectSeeder::class
        ]);
    }
}
