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
        Schema::create('estimates', function (Blueprint $table) {
            $table->id();
            $table->string('serial_number');
            $table->date('date_expiration');
            $table->string('status_expiration');
            $table->decimal('price', 10, 2);
            $table->decimal('total', 10, 2);
            $table->tinyInteger('status')->default(1);
            $table->foreignId('client_id')->nullable()->constrained('clients')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('referent_id')->constrained('referents')->cascadeOnDelete();

            $table->string('address_invoice');
            $table->string('city');
            $table->string('cap', 10);
            $table->string('country');
            $table->boolean('has_same_address_for_delivery')->default(true);

            $table->string('price_list');
            $table->date('expiration');
            $table->string('term_pay');
            $table->string('method_pay');

            $table->string('title_service');
            $table->text('service');
            $table->text('note_service')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estimates');
    }
};
