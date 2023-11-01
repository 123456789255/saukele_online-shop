<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;

class CatalogController extends Controller
{
    public function catalog(Request $request)
    {
        // Получаем параметры сортировки и фильтрации
        $sortBy = $request->input('sort_by', 'created_at');
        $category = $request->input('category', '');
        $subcategory = $request->input('subcategory', '');
        $gender = $request->input('gender', '');
        $filter_size = $request->input('size', '');

        // Получаем список товаров с учетом параметров сортировки и фильтрации
        $products = Product::where('quantity', '>=', 0)
            ->when($category, function ($query, $category) {
                return $query->where('category', $category);
            })
            ->when($gender, function ($query, $gender) {
                return $query->where('gender', $gender);
            })
            ->when($subcategory, function ($query, $subcategory) {
                return $query->where('subcategory', $subcategory);
            })
            ->when($filter_size, function ($query, $filter_size) {
                return $query->where('min_size', '<=', $filter_size)
                    ->where('max_size', '>=', $filter_size);
            })
            ->orderBy($sortBy, $request->input('sort_direction', 'desc'))->get();

        $categories = Category::all();
        $subcategories = Subcategory::all();

        // Create an array of unique sizes based on the min_size and max_size
        $sizes = [];
        foreach ($products as $product) {
            for ($size = $product->min_size; $size <= $product->max_size; $size++) {
                $sizes[$size] = $size;
            }
        }

        // Sort the sizes in ascending order
        asort($sizes);

        // Now $sizes will contain unique sizes in ascending order

        return view('catalog', compact('products', 'category', 'categories', 'sortBy', 'gender', 'subcategories', 'subcategory', 'sizes'));
    }




    public function getCategoriesByGender($gender)
    {
        $categories = Category::where('gender', $gender)->get();
        return response()->json($categories);
    }
}