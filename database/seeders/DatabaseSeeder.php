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

    // ✅ ONLY CATEGORIES
    $categories = [
        'Burger',
        'Pizza',
        'Spaghetti',
        'Sandwich',
        'Chicken Nugget'
    ];

    foreach ($categories as $catName) {
        Category::create([
            'name' => $catName
        ]);
    }
    }
}