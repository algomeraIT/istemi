<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();

            $table->foreignId('client_id')->nullable()->constrained('clients')->cascadeOnDelete();
            $table->foreignId('project_id')->nullable()->constrained('projects')->cascadeOnDelete();

            $table->string('user')->nullable();
            $table->string('status')->nullable();

            $table->boolean('activities')->default(false);
            $table->foreignId('user_activities')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status_activities')->nullable();

            $table->boolean('team')->default(false);
            $table->foreignId('user_team')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status_team')->nullable();

            $table->boolean('field_activities')->default(false);
            $table->foreignId('user_field_activities')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status_field_activities')->nullable();

            $table->boolean('daily_check_activities')->default(false);
            $table->foreignId('user_daily_check_activities')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status_daily_check_activities')->nullable();

            $table->boolean('contruction_site_media')->default(false);
            $table->foreignId('user_contruction_site_media')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status_contruction_site_media')->nullable();

            $table->boolean('activity_validation')->default(false);
            $table->foreignId('user_activity_validation')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status_activity_validation')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
