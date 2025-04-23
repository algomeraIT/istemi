<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('email')->unique();
            $table->string('pec')->nullable();
            $table->string('service');
            $table->string('provenance');
            $table->string('registered_office_address');
            $table->string('first_telephone');
            $table->string('second_telephone')->nullable();
            $table->string('note')->nullable();
            $table->string('sales_manager')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->date('acquisition_date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};