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
        Schema::create('external_validations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->nullable()->constrained('clients')->nullOnDelete();
            $table->foreignId('project_id')->nullable()->constrained('projects')->nullOnDelete();

            $table->string('user')->nullable();
            $table->string('status')->nullable();
    
            $table->boolean('external_validation')->default(false);
            $table->unsignedBigInteger('user_external_validation')->nullable();
            $table->string('status_external_validation')->nullable();
    
            $table->boolean('cre')->default(false);
            $table->unsignedBigInteger('user_cre')->nullable();
            $table->string('status_cre')->nullable();
    
            $table->boolean('liquidation')->default(false);
            $table->unsignedBigInteger('user_liquidation')->nullable();
            $table->string('status_liquidation')->nullable();
    
            $table->boolean('balance_invoice')->default(false);
            $table->unsignedBigInteger('user_balance_invoice')->nullable();
            $table->string('status_balance_invoice')->nullable();
    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('external_validations');
    }
};
