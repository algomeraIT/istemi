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
            $table->string('document_name');
            $table->unsignedBigInteger('project_id');
            $table->string('phase');
    
            $table->unsignedBigInteger('user_id');
    
            $table->string('user_name');
            $table->string('status');
            $table->timestamps();
    
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('project_id')->references('id')->on('projects');
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
