<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('phases', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_area');
            $table->unsignedBigInteger('id_micro_area');
            $table->unsignedBigInteger('id_project');
            $table->unsignedBigInteger('id_user');

            $table->string('status')->default('In attesa');

            $table->timestamps();

            $table->foreign('id_area')->references('id')->on('areas')->onDelete('cascade');
            $table->foreign('id_micro_area')->references('id')->on('micro_areas')->onDelete('cascade');
            $table->foreign('id_project')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');

        });
    }

    public function down(): void {
        Schema::dropIfExists('phases');
    }
};