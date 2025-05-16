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
            $table->foreignId('sales_manager_id')->nullable()->on('users')->nullOnDelete();
            $table->boolean('is_company')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('pec')->nullable();
            $table->string('first_telephone');
            $table->string('second_telephone')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('address')->nullable();
            $table->string('tax_code')->nullable();
            $table->string('p_iva')->nullable();
            $table->string('sdi')->nullable();
            $table->string('site')->nullable();
            $table->string('label')->nullable();
            $table->text('note')->nullable();
            $table->string('service')->nullable();
            $table->string('provenance')->nullable();
            $table->string('registered_office_address')->nullable();
            $table->boolean('has_referent')->nullable();
            $table->string('status');
            $table->string('step')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('deleted_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Schema::dropIfExists('clients');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
};
