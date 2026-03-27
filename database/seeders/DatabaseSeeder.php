<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;

use App\Models\Profile;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // ✅ CREATE USER (VERY IMPORTANT)
        Profile::create([
            'name' => 'Test User',
            'email' => 'test@test.com',
            'password' => bcrypt('123456'),
            'image' => null
        ]);

        // Categories
        $categories = [
            'Burger',
            'Pizza',
            'Spaghetti',
            'Sandwich',
            'Chicken Nugget'
        ];

        foreach ($categories as $catName) {
            $category = Category::create([
                'name' => $catName
            ]);

            for ($i = 1; $i <= 3; $i++) {

                $product = Product::create([
                    'title' => $catName . ' ' . $i,
                    'subtitle' => 'Delicious ' . $catName,
                    'price' => rand(5, 20),
                    'rating' => rand(3, 5),
                    'category_id' => $category->id
                ]);

                for ($j = 1; $j <= 5; $j++) {
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_url' => 'https://picsum.photos/200?random=' . rand(1,1000)
                    ]);
                }
            }
        }
    }
}