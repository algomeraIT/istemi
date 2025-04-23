<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;

class ContactSeeder extends Seeder
{
    public function run(): void
    {
        Contact::factory()->count(1)->fixed()->create();

        Contact::factory()->count(30)->create();
    }
}
