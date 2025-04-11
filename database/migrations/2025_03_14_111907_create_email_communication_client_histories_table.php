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
        if (Schema::hasTable('email_communication_client_history')) {
            return;
        }
        Schema::create('email_communication_client_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->string('task')->nullable();
            $table->string('assigned_to');
            $table->string('sender');
            $table->string('receiver');
            $table->unsignedBigInteger('attach_id')->nullable();
            $table->boolean('has_multiple_attaches')->default(false);
            $table->text('id_multiple_attaches')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('name_user');
            $table->string('last_name_user');
            $table->string('job_position_user');
            $table->tinyInteger('status_user');
            $table->string('action');
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_communication_client_histories');
    }
};
