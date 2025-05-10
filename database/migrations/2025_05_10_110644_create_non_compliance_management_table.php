<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('non_compliance_management', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->nullable()->constrained('clients')->nullOnDelete();
            $table->foreignId('project_id')->nullable()->constrained('projects')->nullOnDelete();

            $table->text('non_compliance_management')->nullable();
            $table->foreignId('user_non_compliance_management')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status_non_compliance_management')->nullable();

            $table->text('sa')->nullable();
            $table->foreignId('user_sa')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status_sa')->nullable();

            $table->text('integrate_doc')->nullable();
            $table->foreignId('user_integrate_doc')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status_integrate_doc')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('non_compliance_management');
    }
};
