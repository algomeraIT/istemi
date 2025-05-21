<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $roles = [
            [
                'name' => 'superAdmin',
                'description' => 'Avrà il controllo totale sulle configurazioni del sistema,la gestione degli utenti e la supervisione delle attività globali.'
            ],
            [
                'name' => 'direttore generale',
                'description' => 'Questo ruolo sarà riservato alla proprietà o alla dirigenza superiore dell\'azienda. Avrà la possibilità di visualizzare, modifIcare e gestire tutte le informazioni presenti nel sistema,senza restrizioni.'
            ],
            [
                'name' => 'responsabile aerea',
                'description' => 'Gli utenti con questo ruolo potranno gestire le informazioni anagrafiche dei clienti, creare e modificare appuntamenti nel calendario condiviso e gestire le pratiche amministrative e burocratiche legate ai clienti e alle commesse. Avrà la supervisione delle attività dei venditori e del personale operativo all\'interno della propria arrea di competenza. Avrà accesso alle informazioni e alle funzionalità necessarie per monitorare e supportare il team. Avrà accesso al lavoro del P.M qualora questo afferisce alla sua Area.'
            ],
            [
                'name' => 'responsabile unità produttiva locale',
                'description' => 'Avrà il compito di gestire e coordinare le attività in campo, relativamente all\'area territoriale di appartenenza. Pertanto, ne gestisce il personale. Avrà la possibilità di gestire un budgrt di spesa limitato, e pertanto assegnato ad un centro di costo.  Inoltre ha tutte le altre funzioni del Responsabile di Area'
            ],
            [
                'name' => 'project manager',
                'description' => 'Responsabile della gestione delle commesse. Questo ruolo prevederà l\'assegnazione delle mansioni ai dipendenti e il monitoraggio del pregresso delle attività relative a ciascuna commessa. Averà accesso alle informazioni necessarie per coordinare le risorse e garantire il completamento delle commesse nei tempi e nei costi previsti. '
            ],
            [
                'name' => 'commerciale',
                'description' => 'Il commerciale sarà l\'utente che interagirà direttamente con i clienti per l\'attività di vendita. Questo ruolo includerà la creazione e gestione delle anagrafiche dei clienti, la pianifcazione degli appuntamenti e la gestione dei preventivi.Il commerciale avrà accesso limitato alle informazioni generali per svolgere le proprie attività senza compromettere la riservatezza delle informazioni aziendali sensibili.'
            ],
            [
                'name' => 'dipendente/collaboratore',
                'description' => 'Il dipendente/collaboratore eseguirà mansioni assegnate dal Responsabile di Area.Questo ruolo avrà accesso alle informazioni e agli strumenti necessari per completare i compiti assegnati. Le funzionalità accessibili saranno limitate alle attività specifiche e alle commesse in cui sarà coinvolto. '
            ],
            [
                'name' => 'responsabile attività in campo',
                'description' => 'Avrà il compito di sorvegliare i lavori e assicurarne la corretta esecuzione. E\' incaricato della vigilanza degli strumenti/impianti come previsto dal progetto e dal piano di sicurezza, nonché alla trascrizione dei dati rilevati su app aziendale.'
            ],
            [
                'name' => 'unità esterna',
                'description' => 'Soggetto esterno (cliente/ committente - stazione appaltante - RUP) avrà la possibilità di accedere alla visualizzazione/avanzamento di una singola commessa e di un preventivo. Potrà: firmare in digitale i preventivi, scaricare eventuali dati di cantiere, e report tecnico finale (certificato di prova)'
            ],
        ];

        foreach ($roles as $key => $role) {
            Role::updateOrCreate([
                'name' => $role['name'],
                'description' => $role['description'],
            ]);
        }

        // TODO definire in seguito i permessi necessari da registrare
        $permissions = [
            'view users',
            'create users',
            'edit users',
            'delete users',
        ];

        foreach ($permissions as $permissionName) {
            Permission::updateOrCreate(['name' => $permissionName]);
        }

        // Assegna tutti i permessi al superAdmin
        $superAdmin = Role::where('name', 'superAdmin')->first();
        $superAdmin->syncPermissions(Permission::all());

        // TODO assegnazione dei permessi ai ruoli
    }
}
