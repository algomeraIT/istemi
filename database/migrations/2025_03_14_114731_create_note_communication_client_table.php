<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('note_communication_client', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade'); // Foreign key to clients
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Foreign key to users
            $table->string('name_user');
            $table->string('last_name_user');
            $table->string('role_user');
            $table->unsignedBigInteger('attach_id')->nullable();
            $table->unsignedBigInteger('id_note');
            $table->timestamps(); // created_at and updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('note_communication_client');
    }
};