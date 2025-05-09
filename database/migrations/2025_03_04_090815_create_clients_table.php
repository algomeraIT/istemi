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
            $table->foreignId('parent_id')->nullable()->constrained('clients')->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('estimate_id')->nullable()->constrained('estimates')->nullOnDelete();
            $table->boolean('is_company');
            $table->string('logo_path')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('pec')->nullable();
            $table->string('first_telephone');
            $table->string('second_telephone')->nullable();
            $table->string('country');
            $table->string('city');
            $table->string('province');
            $table->string('address');
            $table->string('tax_code');
            $table->string('sdi');
            $table->string('site')->nullable();
            $table->string('label')->nullable();
            $table->text('note')->nullable();
            $table->string('service')->nullable();
            $table->string('provenance')->nullable();
            $table->string('registered_office_address');
            $table->string('sales_manager')->nullable();
            $table->boolean('has_referent')->default(false);
            $table->string('status');
            $table->string('step');
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
