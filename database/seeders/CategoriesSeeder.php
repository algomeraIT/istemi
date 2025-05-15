<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\ProductCategory;

class CategoriesSeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('seeders/data/categories.json');
        $items = collect(json_decode(File::get($path), true));

        // 1) Root categories (parent_id = null)
        $roots = $items->whereNull('parent_id');
        foreach ($roots as $item) {
            ProductCategory::updateOrCreate(
                ['id' => $item['id']],
                [
                    'name'          => $item['name'],
                    'complete_name' => $item['complete_name'],
                    'parent_id'     => null,
                ]
            );
        }

        // 2) Child categories (parent_id != null)
        $children = $items->whereNotNull('parent_id');
        foreach ($children as $item) {
            ProductCategory::updateOrCreate(
                ['id' => $item['id']],
                [
                    'name'          => $item['name'],
                    'complete_name' => $item['complete_name'],
                    'parent_id'     => $item['parent_id'],
                ]
            );
        }

        $this->command->info('Seeded categories: ' . $items->count());
    }
}
