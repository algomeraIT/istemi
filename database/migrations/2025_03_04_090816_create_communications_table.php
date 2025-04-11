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
        if (Schema::hasTable('communications')) {
            return;
        }
        
        Schema::create('communications', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->string('task');
            $table->string('assigned_to');
            $table->date('deadline');
            $table->text('to_do');
            $table->string('sender');
            $table->string('receiver');
            $table->foreignId('attach_id')->nullable()->constrained('attaches')->onDelete('set null');
            $table->boolean('has_multiple_attaches')->default(false);
            $table->string('id_multiple_attaches')->nullable();
            $table->foreignId('notes')->constrained('notes')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('name_user');
            $table->string('last_name_user');
            $table->string('job_position_user');
            $table->string('status_user');
            $table->string('action');
            $table->text('note');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('communications');
    }
};
