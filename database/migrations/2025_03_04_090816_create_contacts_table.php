<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id(); // This automatically creates an auto-incrementing primary key
            $table->string('company_name');
            $table->string('email')->unique();
            $table->string('pec')->nullable();
            $table->string('registered_office_address');
            $table->string('first_telephone');
            $table->string('second_telephone')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
