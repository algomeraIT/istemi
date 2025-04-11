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
        Schema::create('histories', function (Blueprint $table) {
            $table->id(); // This automatically creates an auto-incrementing primary key
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('name_user');
            $table->string('last_name_user');
            $table->string('job_position_user');
            $table->string('role_user');
            $table->string('status_user');
            $table->string('action');
            $table->foreignId('id_notes')->constrained('notes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histories');
    }
};
