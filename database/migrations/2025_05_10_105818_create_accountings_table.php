<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('accountings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('project_id')->nullable()->constrained()->nullOnDelete();
            $table->text('accounting')->nullable();
            $table->unsignedBigInteger('user_accounting')->nullable();
            $table->string('status_accounting')->nullable();
            $table->text('accounting_dec')->nullable();
            $table->unsignedBigInteger('user_accounting_dec')->nullable();
            $table->string('status_accounting_dec')->nullable();
            $table->text('create_cre')->nullable();
            $table->unsignedBigInteger('user_create_cre')->nullable();
            $table->string('status_create_cre')->nullable();
            $table->text('expense_allocation')->nullable();
            $table->unsignedBigInteger('user_expense_allocation')->nullable();
            $table->string('status_expense_allocation')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('accountings');
    }
};