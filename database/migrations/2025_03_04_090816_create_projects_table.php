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
        Schema::create('projects', function (Blueprint $table) {
            $table->id(); // This automatically creates an auto-incrementing primary key
            $table->string('phase');
            $table->string('estimate');
            $table->foreignId('id_client')->constrained('clients')->onDelete('cascade');
            $table->string('client_name')->nullable();
            $table->string('logo_path_client')->nullable();
            $table->text('note_client')->nullable();
            $table->string('address_client');
            $table->string('client_status');
            $table->text('note')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->boolean('is_archived')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
