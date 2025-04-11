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
        Schema::table('note_communication_client_histories', function (Blueprint $table) {
            $table->dropColumn('id_note');
        });
    }

    public function down(): void
    {
        Schema::table('note_communication_client_histories', function (Blueprint $table) {
            $table->bigInteger('id_note')->nullable(); // Adjust type if needed
        });
    }
};
