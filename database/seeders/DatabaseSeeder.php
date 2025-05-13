<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Sale;
use App\Models\Referent;
use App\Models\Acquisition;
use App\Models\Communication;
use App\Models\AccountingOrder;
use Illuminate\Database\Seeder;
use App\Models\AccountingInvoice;
use App\Models\ActivityCommunicationClientHistory;

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
            ArchiveSeeder::class,
            AttachSeeder::class,
            EmailCommunicationClientHistorySeeder::class,
            EstimateSeeder::class,
            HistorySeeder::class,
            NoteCommunicationClientHistorySeeder::class,
            NoteCommunicationClientSeeder::class,
            NoteSeeder::class,
            PhaseSeeder::class,
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

        Referent::factory()->count(40)->create();
        $this->command->info('Referenti creati con successo.');

        Sale::factory()->count(40)->create();
        $this->command->info('Vendite create con successo.');

        Acquisition::factory()->count(40)->create();
        $this->command->info('Acquisti create con successo.');

        AccountingOrder::factory()->count(40)->create();
        $this->command->info('Ordini create con successo.');

        AccountingInvoice::factory()->count(40)->create();
        $this->command->info('Fatture create con successo.');

        Communication::factory()->count(80)->create();
        $this->command->info('Comunicazioni create con successo.');

        ActivityCommunicationClientHistory::factory()->count(80)->create();
        $this->command->info('Comunicazioni attivita create con successo.');

    }
}
