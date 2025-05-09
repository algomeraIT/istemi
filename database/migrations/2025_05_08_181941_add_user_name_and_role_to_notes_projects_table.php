<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('notes_projects', function (Blueprint $table) {
            $table->string('user_name')->after('note');
            $table->string('role')->after('user_name');
            $table->foreignId('user_id')
            ->constrained('users')
            ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('notes_projects', function (Blueprint $table) {
            $table->dropColumn(['role', 'user_name']);
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};