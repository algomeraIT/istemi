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
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->text('answer');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->text('note')->nullable();
            $table->string('id_attach')->nullable(); 
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
