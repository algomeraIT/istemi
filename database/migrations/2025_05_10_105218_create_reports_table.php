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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('project_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name_phase')->nullable();

            $table->string('user')->nullable();
            $table->string('status')->nullable();
    
            $table->boolean('report')->default(false);
            $table->foreignId('user_report')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status_report')->nullable();
    
            $table->boolean('create_note')->default(false);
            $table->foreignId('user_create_note')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status_create_note')->nullable();
    
            $table->boolean('sending_note')->default(false);
            $table->foreignId('user_sending_note')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status_sending_note')->nullable();
    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
