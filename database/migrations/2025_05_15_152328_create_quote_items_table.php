<?php

use App\Enums\MeasurementUnitEnum;
use App\Models\Product;
use App\Models\Quote;
use App\Models\QuoteItemGroup;
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
        Schema::create('quote_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Product::class)->nullable()->constrained();
            $table->foreignIdFor(QuoteItemGroup::class)->nullable()->constrained();
            $table->enum('type',['product','note', 'title']);
            $table->decimal('quantity',10,2)->default(1)->nullable();
            $table->enum('uom', MeasurementUnitEnum::valuesArray())->comment('unità di misura');
            $table->decimal('unit_price',12,2)->default(0);
            $table->unsignedTinyInteger('discount_pct')->default(0);
            $table->decimal('line_total',12,2)->default(0);
            $table->boolean('is_cnpaia')->default(false);
            $table->string('title')->nullable();
            $table->text('note')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quote_items');
    }
};
