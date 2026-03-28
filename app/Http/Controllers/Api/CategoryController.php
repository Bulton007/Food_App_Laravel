<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    // GET ALL CATEGORIES
    public function index()
    {
        return Category::all();
    }

    // CREATE CATEGORY (optional)
    public function store(Request $request)
    {
        $category = Category::create([
            'name' => $request->name
        ]);

        return response()->json([
            'message' => 'Category created',
            'data' => $category
        ]);
    }
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'Burger'],
            ['name' => 'Pizza'],
            ['name' => 'Spaghetti'],
            ['name' => 'Sandwich'],
            ['name' => 'Chicken Nugget'],
        ]);
    }
}