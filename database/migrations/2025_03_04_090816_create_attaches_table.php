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
        Schema::create('attaches', function (Blueprint $table) {
            $table->id(); // This automatically creates an auto-incrementing primary key
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('path');
            $table->string('disk_path');
            $table->string('real_name');
            $table->string('saved_name');
            $table->integer('size');
            $table->string('extension');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attaches');
    }
};
