<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = Category::create(['name' => 'Electronics', 'slug' => 'electronics']);

        Product::create([
            'category_id' => $category->id,
            'name' => 'Smartphone',
            'slug' => 'smartphone',
            'description' => 'A high-end smartphone with a sleek design.',
            'price' => 699.99,
            'stock_quantity' => 50,
        ]);
    }
}
