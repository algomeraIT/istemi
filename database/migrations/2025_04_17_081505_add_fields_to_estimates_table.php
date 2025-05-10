<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('estimates', function (Blueprint $table) {
            $table->foreignId('client_id')->nullable()->after('id')->constrained('clients')->cascadeOnDelete();
            $table->foreignId('user_id')->after('client_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('referent_id')->after('user_id')->constrained('referents')->cascadeOnDelete();

            $table->string('address_invoice')->after('referent_id');
            $table->string('city')->after('address_invoice');
            $table->string('cap', 10)->after('city');
            $table->string('country')->after('cap');
            $table->boolean('has_same_address_for_delivery')->default(true)->after('country');

            $table->string('price_list')->after('has_same_address_for_delivery');
            $table->date('expiration')->after('price_list');
            $table->string('term_pay')->after('expiration');
            $table->string('method_pay')->after('term_pay');

            $table->string('title_service')->after('method_pay');
            $table->text('service')->after('title_service');
            $table->text('note_service')->nullable()->after('service');
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('estimates')) {
            return;
        }
    
        Schema::table('estimates', function (Blueprint $table) {
            // Drop foreign keys first
            if (Schema::hasColumn('estimates', 'client_id')) {
                $table->dropForeign(['client_id']);
            }
    
            if (Schema::hasColumn('estimates', 'user_id')) {
                $table->dropForeign(['user_id']);
            }
    
            if (Schema::hasColumn('estimates', 'referent_id')) {
                $table->dropForeign(['referent_id']);
            }
    
            // Then drop all columns once
            $columnsToDrop = [
                'note_service', 'service', 'title_service', 'method_pay',
                'term_pay', 'expiration', 'price_list',
                'has_same_address_for_delivery', 'country', 'cap', 'city', 'address_invoice',
                'referent_id', 'user_id', 'client_id',
            ];
    
            foreach ($columnsToDrop as $column) {
                if (Schema::hasColumn('estimates', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
