<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('close_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->nullable()->constrained('clients')->nullOnDelete();
            $table->foreignId('project_id')->nullable()->constrained('projects')->nullOnDelete();

            $table->text('close_activity')->nullable();
            $table->foreignId('user_close_activity')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status_close_activity')->nullable();

            $table->text('sale')->nullable();
            $table->foreignId('user_sale')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status_sale')->nullable();

            $table->text('release')->nullable();
            $table->foreignId('user_release')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status_release')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('close_activities');
    }
};
