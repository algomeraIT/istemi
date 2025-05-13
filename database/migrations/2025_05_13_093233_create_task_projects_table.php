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
        Schema::create('task_projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('user_id');
            $table->string('user_name');
            $table->unsignedBigInteger('project_start_id')->nullable();
            $table->unsignedBigInteger('project_activity_id')->nullable();
            $table->unsignedBigInteger('project_accounting_id')->nullable();
            $table->unsignedBigInteger('project_data_id')->nullable();
            $table->unsignedBigInteger('project_construction_site_plane_id')->nullable();
            $table->unsignedBigInteger('project_external_validations_id')->nullable();
            $table->unsignedBigInteger('project_invoices_sal_id')->nullable();
            $table->unsignedBigInteger('project_non_compliance_id')->nullable();
            $table->unsignedBigInteger('project_report_id')->nullable();
            $table->unsignedBigInteger('project_close_id')->nullable();
            $table->string('title');
            $table->string('assignee')->nullable();
            $table->string('cc')->nullable();
            $table->date('expire')->nullable();
            $table->text('note')->nullable();
            $table->json('media')->nullable();
            $table->string('status')->default('In attesa');
        
   
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_projects');
    }
};
