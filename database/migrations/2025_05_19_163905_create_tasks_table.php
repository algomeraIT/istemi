<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->unsignedBigInteger('id_phases');
            $table->unsignedBigInteger('id_assignee');
            $table->string('status')->default('In attesa');

            $table->timestamps();

            // Foreign keys
            $table->foreign('id_phases')->references('id')->on('phases')->onDelete('cascade');
            $table->foreign('id_assignee')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('tasks');
    }
};