<?php

use App\Enums\MeasurementUnitEnum;
use App\Models\Product;
use App\Models\QuoteTemplate;
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
        Schema::create('quote_template_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(QuoteTemplate::class)->constrained()->cascadeOnDelete();
            $table->enum('type', ['product','text']);
            $table->foreignIdFor(Product::class)->nullable()->constrained()->nullOnDelete();
            $table->text('description');
            $table->decimal('quantity',10,2)->nullable();
            $table->enum('uom', MeasurementUnitEnum::valuesArray())->comment('unità di misura');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quote_template_lines');
    }
};
