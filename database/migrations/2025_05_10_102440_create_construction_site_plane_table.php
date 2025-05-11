<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('construction_site_plane', function (Blueprint $table) {
            $table->id();

            $table->foreignId('client_id')->nullable()->constrained('clients')->cascadeOnDelete();
            $table->foreignId('project_id')->nullable()->constrained('projects')->cascadeOnDelete();

            $table->string('user')->nullable();
            $table->string('status')->nullable();

            $table->boolean('construction_site_plane')->default(false);
            $table->foreignId('user_construction_site_plane')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status_construction_site_plane')->nullable();

            $table->boolean('inspection')->default(false);
            $table->foreignId('user_inspection')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status_inspection')->nullable();

            $table->boolean('travel')->default(false);
            $table->foreignId('user_travel')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status_travel')->nullable();

            $table->boolean('site_pass')->default(false);
            $table->foreignId('user_site_pass')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status_site_pass')->nullable();

            $table->boolean('ztl')->default(false);
            $table->foreignId('user_ztl')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status_ztl')->nullable();

            $table->boolean('supplier')->default(false);
            $table->foreignId('user_supplier')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status_supplier')->nullable();

            $table->boolean('timetable')->default(false);
            $table->foreignId('user_timetable')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status_timetable')->nullable();

            $table->boolean('security')->default(false);
            $table->foreignId('user_security')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status_security')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('construction_site_plane');
    }
};
