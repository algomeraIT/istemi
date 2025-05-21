<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::factory()->create([
            'name' => 'Super',
            'last_name' => 'Admin',
            'email' => 'admin@example.com',
        ]);
        $admin->assignRole('superAdmin');

        $roleEmailMap = [
            'direttore generale' => 'direttore',
            'responsabile aerea' => 'responsabile_aerea',
            'responsabile unità produttiva locale' => 'responsabile_unita_produttiva_locale',
            'project manager' => 'project_manager',
            'commerciale' => 'commerciale',
            'dipendente/collaboratore' => 'dipendente_collaboratore',
            'responsabile attività in campo' => 'responsabile_attivita',
            'unità esterna' => 'unita_esterna',
        ];

        $roles = Role::where('name', '!=', 'superAdmin')->get();

        foreach ($roles as $role) {
            $normalizedRoleName = $roleEmailMap[$role->name] ?? 'ruolo_generico';

            for ($i = 1; $i <= 5; $i++) {
                $user = User::factory()->create([
                    'email' => "{$normalizedRoleName}{$i}@example.com",
                ]);

                $user->assignRole($role->name);
            }
        }
    }
}
