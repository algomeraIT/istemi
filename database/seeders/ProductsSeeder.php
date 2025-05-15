<?php

namespace Database\Seeders;

use App\Enums\MeasurementUnitEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\ProductCategory; // il tuo model per product_categories
use Illuminate\Support\Str;

class ProductsSeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('seeders/data/product_odoo_active.json');

        if (! File::exists($path)) {
            $this->command->error("File not found: {$path}");
            return;
        }

        $records = json_decode(File::get($path), true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->command->error("JSON error: " . json_last_error_msg());
            return;
        }

        foreach ($records as $odoo) {
            // Estrai il leaf-category dal complete_name
            $full = $odoo['category_complete_name'] ?? $odoo['category_name'];
            // Se c'è una slash, prendi la parte dopo l'ultima slash
            if (Str::contains($full, '/')) {
                $parts = array_map('trim', explode('/', $full));
                $leaf  = end($parts);
            } else {
                $leaf = trim($full);
            }

            // Lookup in product_categories
            $cat = ProductCategory::where('name', $leaf)->first();
            $categoryId = $cat ? $cat->id : null;

            $uomName      = $odoo['uom_name']      ?? 'Unità';

            $uomEnum = MeasurementUnitEnum::tryFrom($uomName) ?? MeasurementUnitEnum::UNITA;

            // Prepara i campi
            $isActive    = filter_var($odoo['is_active'], FILTER_VALIDATE_BOOLEAN);
            $price       = $odoo['price'] ?? 0.0;
            $title       = trim($odoo['title'] ?? $odoo['name'] ?? '');
            $description = trim($odoo['description'] ?? $odoo['description_sale'] ?? '');

            $uniqueCode = $odoo['default_code'];

            $uniqueCode = $uniqueCode ?? generateUniqueCode(
                \App\Models\Product::class,
                'unique_code',
                $cat->name,
                $title
            );;

            // Se tu avessi una tabella uoms, potresti fare un lookup simile
            // $uom = Uom::where('name', $uomClean)->first();
            // $uomId = $uom ? $uom->id : null;

            DB::table('products')->insert([
                'unique_code'           => $uniqueCode,
                'product_category_id'   => $categoryId,
                'uom'                   => $uomEnum->value,
                'title'                 => $title,
                'description'           => $description ?: null,
                'price'                 => $price,
                'is_active'             => $isActive,
                'is_cnpaia'             => true,
                'created_at'            => now(),
                'updated_at'            => now(),
            ]);
        }

        $this->command->info('Seeded products: ' . count($records));
    }
}
