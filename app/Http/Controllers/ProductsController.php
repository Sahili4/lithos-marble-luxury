<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->get('category');
        $perPage = 12;

        // Build query
        $query = Catalog::active()->ordered();

        // Filter by category if provided
        if ($category) {
            $query->where('type', $category);
        }

        $catalogs = $query->paginate($perPage);

        // Get all categories for filter
        $categories = Catalog::select('type')
            ->whereNotNull('type')
            ->where('type', '!=', '')
            ->where('status', true)
            ->distinct()
            ->orderBy('type')
            ->pluck('type');

        return view('products', compact('catalogs', 'categories', 'category'));
    }
}
