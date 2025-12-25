<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $perPage = 8; // Initial load
        $category = $request->get('category');

        // Build query
        $query = Catalog::active()->ordered();

        // Filter by category if provided
        if ($category) {
            $query->where('type', $category);
        }

        if ($request->ajax()) {
            // Load more via AJAX
            $catalogs = $query->paginate($perPage);
            return response()->json([
                'html' => view('partials.catalog-cards', compact('catalogs'))->render(),
                'hasMore' => $catalogs->hasMorePages()
            ]);
        }

        $catalogs = $query->paginate($perPage);
        $featured_catalogs = Catalog::active()->featured()->ordered()->take(4)->get();

        return view('home', compact('catalogs', 'featured_catalogs', 'category'));
    }
}
