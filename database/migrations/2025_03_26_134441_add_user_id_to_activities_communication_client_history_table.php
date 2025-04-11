<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToActivitiesCommunicationClientHistoryTable extends Migration
{
    public function up()
    {
        Schema::table('activities_communication_client_history', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null')->after('client_id');
        });
    }

    public function down()
    {
        Schema::table('activities_communication_client_history', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
}
