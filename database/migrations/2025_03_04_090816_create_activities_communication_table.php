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
        Schema::create('activities_communication_client_history', function (Blueprint $table) {
            $table->id(); // This automatically creates an auto-incrementing primary key
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->string('name');
            $table->string('last_name');
            $table->string('role');
            $table->string('label')->nullable();
            $table->string('to_do');
            $table->text('activities');
            $table->string('assignee');
            $table->date('expire_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities_communication_client_history');
    }
};
