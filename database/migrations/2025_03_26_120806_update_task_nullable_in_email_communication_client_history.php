<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
      /*   Schema::table('email_communication_client_history', function (Blueprint $table) {
            $table->string('task')->change();
        }); */
    }

    public function down(): void
    {
     /*    Schema::table('email_communication_client_history', function (Blueprint $table) {
            $table->string('task')->change();
        }); */
    }
};
