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
        Schema::create('document_projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->on('users')->nullOnDelete();
            $table->foreignId('project_id')->nullable()->on('projects')->onDelete('cascade');
            $table->string('document_name');
            $table->string('phase');
            $table->string('user_name');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_projects');
    }
};
