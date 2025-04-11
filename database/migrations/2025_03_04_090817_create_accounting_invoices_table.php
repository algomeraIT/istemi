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
        Schema::create('accounting_invoices', function (Blueprint $table) {
            $table->id(); // This automatically creates an auto-incrementing primary key
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->string('number_invoice');
            $table->date('date_invoice');
            $table->date('expire_invoice');
            $table->decimal('taxable', 10, 2);
            $table->decimal('total', 10, 2);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounting_invoices');
    }
};
