<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id(); 
            $table->string('logo_path')->nullable();
            $table->string('tax_code');
            $table->string('company_name');
            $table->string('email')->unique();
            $table->string('pec')->nullable();
            $table->string('first_telephone');
            $table->string('second_telephone')->nullable();
            $table->string('registered_office_address');
            $table->string('address');
            $table->string('province');
            $table->string('city');
            $table->string('country');
            $table->string('sdi');
            $table->string('site')->nullable();
            $table->string('label')->nullable();
            $table->foreignId('user_id_creation')->constrained('users')->onDelete('cascade');
            $table->string('name_user_creation');
            $table->string('last_name_user_creation');
            $table->boolean('has_referent')->default(false);
            $table->boolean('has_sales')->default(false);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Schema::dropIfExists('clients');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
};
