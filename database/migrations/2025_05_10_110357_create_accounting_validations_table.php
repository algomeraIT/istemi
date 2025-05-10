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
        Schema::create('accounting_validations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->nullable()->constrained('clients')->nullOnDelete();
            $table->foreignId('project_id')->nullable()->constrained('projects')->nullOnDelete();
        
            $table->boolean('accounting_validation')->default(false);
            $table->unsignedBigInteger('user_accounting_validation')->nullable();
            $table->string('status_accounting_validation')->nullable();
        
            $table->boolean('balance')->default(false);
            $table->unsignedBigInteger('user_balance')->nullable();
            $table->string('status_balance')->nullable();
        
            $table->boolean('cre_archiving')->default(false);
            $table->unsignedBigInteger('user_cre_archiving')->nullable();
            $table->string('status_cre_archiving')->nullable();
        
            $table->boolean('pay_suppliers')->default(false);
            $table->unsignedBigInteger('user_pay_suppliers')->nullable();
            $table->string('status_pay_suppliers')->nullable();
        
            $table->boolean('pay_allocation_expenses')->default(false);
            $table->unsignedBigInteger('user_pay_allocation_expenses')->nullable();
            $table->string('status_pay_allocation_expenses')->nullable();
        
            $table->boolean('learned_lesson')->default(false);
            $table->unsignedBigInteger('user_learned_lesson')->nullable();
            $table->string('status_learned_lesson')->nullable();
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounting_validations');
    }
};
