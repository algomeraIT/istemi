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
        Schema::create('general_terms', function (Blueprint $table) {
            $table->id();
            $table->string('name');      // breve titolo del blocco, es. “TERMS & CONDITIONS”
            $table->longText('text');    // testo con placeholder, es. “These terms apply to {{issuer.name}}…”
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_terms');
    }
};
