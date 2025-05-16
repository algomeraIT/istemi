<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryClientsTable extends Migration
{
    public function up()
    {
        Schema::create('history_clients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients')->cascadeOnDelete();
            $table->string('type');      
            $table->string('action');      
            $table->unsignedBigInteger('model_id');     
            $table->string('status_client')->nullable();    
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('history_clients');
    }
}