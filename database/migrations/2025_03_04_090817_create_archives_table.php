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
        Schema::create('archives', function (Blueprint $table) {
            $table->id(); // This automatically creates an auto-incrementing primary key
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');
            $table->string('last_phase');
            $table->text('note_project')->nullable();
            $table->string('estimate_project');
            $table->foreignId('id_client')->constrained('clients')->onDelete('cascade');
            $table->string('name_client');
            $table->string('logo_path_client')->nullable();
            $table->text('note_client')->nullable();
            $table->string('address_client');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archives');
    }
};
