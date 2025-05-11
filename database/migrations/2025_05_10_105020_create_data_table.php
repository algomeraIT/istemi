<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->nullable()->constrained('clients')->nullOnDelete();
            $table->foreignId('project_id')->nullable()->constrained('projects')->nullOnDelete();

            $table->string('user')->nullable();
            $table->string('status')->nullable();
            
            $table->text('data')->nullable();
            $table->unsignedBigInteger('user_data')->nullable();
            $table->string('status_data')->nullable();

            $table->text('foreman_docs')->nullable();
            $table->unsignedBigInteger('user_foreman_docs')->nullable();
            $table->string('status_foreman_docs')->nullable();

            $table->text('sanding_sample_lab')->nullable();
            $table->unsignedBigInteger('user_sanding_sample_lab')->nullable();
            $table->string('status_sanding_sample_lab')->nullable();

            $table->text('data_validation')->nullable();
            $table->unsignedBigInteger('user_data_validation')->nullable();
            $table->string('status_data_validation')->nullable();

            $table->text('internal_validation')->nullable();
            $table->unsignedBigInteger('user_internal_validation')->nullable();
            $table->string('status_internal_validation')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data');
    }
};
