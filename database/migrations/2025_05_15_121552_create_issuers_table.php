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
        Schema::create('issuers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address')->nullable();
            $table->string('vat')->nullable();
            $table->string('sdi_code')->nullable();            // SDI// Sede legale
            $table->string('fiscal_code')->nullable();         // Codice fiscale
            $table->string('currency')->nullable();            // Valuta
            $table->string('main_company')->nullable();        // Azienda principale

            // registro imprese / REA
            $table->string('rea_number')->nullable();          // Numero REA
            $table->decimal('share_capital', 15, 2)->nullable(); // Capitale sociale

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issuers');
    }
};
