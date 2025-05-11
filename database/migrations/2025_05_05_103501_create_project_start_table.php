<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('project_start', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->string('name_phase')->nullable();

            $table->string('user')->nullable();
            $table->string('status')->nullable();
            
            $table->boolean('contract_ver')->default(true);
            $table->string('user_contract_ver')->nullable();
            $table->string('status_contract_ver')->nullable();

            $table->boolean('cme_ver')->default(true);
            $table->string('user_cme_ver')->nullable();
            $table->string('status_cme_ver')->nullable();

            $table->boolean('reserves')->default(true);
            $table->string('user_reserves')->nullable();
            $table->string('status_reserves')->nullable();

            $table->boolean('expiring_date_project')->default(true);
            $table->date('user_expiring_date_project')->nullable();
            $table->string('status_expiring_date_project')->nullable();

            $table->boolean('communication_plan')->default(true);
            $table->string('user_communication_plan')->nullable();
            $table->string('status_communication_plan')->nullable();

            $table->boolean('extension')->default(true);
            $table->string('user_extension')->nullable();
            $table->string('status_extension')->nullable();

            $table->boolean('sal')->default(true);
            $table->string('user_sal')->nullable();
            $table->string('status_sal')->nullable();

            $table->boolean('warranty')->default(true);
            $table->string('user_warranty')->nullable();
            $table->string('status_warranty')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_start');
    }
};
