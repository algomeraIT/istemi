<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        if (!Schema::hasColumn('email_communication_client_history', 'assigned_to')) {
            return; 
        }

        Schema::table('email_communication_client_history', function (Blueprint $table) {
            $table->string('assigned_to')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('email_communication_client_history', function (Blueprint $table) {
            $table->string('assigned_to')->nullable()->change();
        });
    }
};
