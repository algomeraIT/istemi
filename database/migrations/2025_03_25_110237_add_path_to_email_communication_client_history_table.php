<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('email_communication_client_history', function (Blueprint $table) {
            $table->json('path')->nullable(); // Adding 'path' column as a JSON type
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('email_communication_client_history', function (Blueprint $table) {
            $table->dropColumn('path'); // Drop the 'path' column if rolling back
        });
    }
};
