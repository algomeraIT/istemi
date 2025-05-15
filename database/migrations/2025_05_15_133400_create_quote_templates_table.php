<?php

use App\Models\Issuer;
use App\Models\PriceList;
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
        Schema::create('quote_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name');              // es. “Standard Model”
            $table->foreignIdFor(Issuer::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(PriceList::class)->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quote_templates');
    }
};
