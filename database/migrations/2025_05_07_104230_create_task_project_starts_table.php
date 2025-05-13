<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('task_project_start', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('project_start_id');
            $table->unsignedBigInteger('user_id');
            $table->string('user_name');
            $table->string('title');
            $table->string('assignee');
            $table->string('cc')->nullable();
            $table->date('expire')->nullable();
            $table->text('note')->nullable();
            $table->json('media')->nullable(); 
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_project_start');
    }
};
