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
        Schema::create('notes', function (Blueprint $table) {
            $table->id(); // This automatically creates an auto-incrementing primary key
            $table->boolean('is_leads')->default(false);
            $table->boolean('is_communication')->default(false);
            $table->boolean('is_project')->default(false);
            $table->boolean('is_referent')->default(false);
            $table->boolean('is_email')->default(false);
            $table->text('body');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
