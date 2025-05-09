<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryContactsTable extends Migration
{
    public function up()
    {
        Schema::create('history_contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('client_id')->constrained('clients')->cascadeOnDelete();
            $table->foreignId('estimate_id')->nullable()->constrained('estimates')->nullOnDelete();
            $table->string('type');               
            $table->string('name');               
            $table->string('last_name');
            $table->string('role');              
            $table->string('action');            
            $table->text('note')->nullable();
            $table->string('update_status_from_to')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('history_contacts');
    }
}