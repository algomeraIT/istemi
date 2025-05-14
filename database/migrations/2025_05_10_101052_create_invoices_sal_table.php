<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('invoices_sal', function (Blueprint $table) {
            $table->id();

            $table->foreignId('client_id')->nullable()->constrained('clients')->cascadeOnDelete();
            $table->foreignId('project_id')->nullable()->constrained('projects')->cascadeOnDelete();
            $table->string('name_phase')->nullable();

            $table->string('user')->nullable();
            $table->string('status')->nullable();
            $table->boolean('invoices_sal')->default(false);
            $table->foreignId('user_invoices_sal')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status_invoices_sal')->nullable();

            $table->boolean('emission_invoice')->default(false);
            $table->foreignId('user_emission_invoice')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status_emission_invoice')->nullable();

            $table->boolean('payment_invoice')->default(false);
            $table->foreignId('user_payment_invoice')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status_payment_invoice')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices_sal');
    }
};
