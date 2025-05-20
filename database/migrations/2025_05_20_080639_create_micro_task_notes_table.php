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
        Schema::create('micro_task_notes', function (Blueprint $table) {
            $table->id();
            $table->text('note')->nullable();
            $table->unsignedBigInteger('id_task');
            $table->unsignedBigInteger('id_user');
            $table->string('status')->default('attivo');
            $table->timestamps();
    
            $table->foreign('id_task')->references('id')->on('tasks')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('micro_task_notes');
    }
};
