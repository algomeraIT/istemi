<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            // Add the three new foreign‐key columns
            $table->foreignId('client_id')
                  ->after('id')
                  ->constrained('clients')
                  ->cascadeOnDelete();

            $table->foreignId('user_id')
                  ->after('client_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            $table->foreignId('estimate_id')
                  ->after('user_id')
                  ->nullable()
                  ->constrained('estimates')
                  ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropForeign(['estimate_id']);
            $table->dropColumn('estimate_id');

            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');

            $table->dropForeign(['client_id']);
            $table->dropColumn('client_id');
        });
    }
};