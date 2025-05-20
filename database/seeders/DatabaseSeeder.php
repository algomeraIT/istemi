<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Sale;
use App\Models\Referent;
use App\Models\Acquisition;
use App\Models\ActivityPhase;
use App\Models\Communication;
use App\Models\AccountingOrder;
use Illuminate\Database\Seeder;
use App\Models\AccountingInvoice;
use Database\Factories\ActivityPhaseFactory;
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
            EstimateSeeder::class,
            HistorySeeder::class,
            ActivitySeeder::class,
            EmailSeeder::class,
            NoteSeeder::class,
            NoteProjectSeeder::class,
           /*  ProjectStartSeeder::class, */
          /*   TaskProjectStartSeeder::class, */
            DocumentProjectSeeder::class,
        /*     InvoicesSalSeeder::class,
            ConstructionSitePlaneSeeder::class,
            DataSeeder::class,
            ReportSeeder::class,
            AccountingSeeder::class,
            ExternalValidationSeeder::class,
            AccountingValidationSeeder::class,
            NonComplianceManagementSeeder::class,
            CloseActivitySeeder::class, 
            NoteTaskProjectStartSeeder::class,*/
            TaskProjectSeeder::class,
            AreaSeeder::class,
            MicroAreaSeeder::class,
            PhaseSeeder::class,
            TaskSeeder::class,
            MicroTaskNoteSeeder::class,
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
    }
}
