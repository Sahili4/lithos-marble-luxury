<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the homepage.
     */
    public function index(Request $request)
    {
        $perPage = 8; // Initial load

        if ($request->ajax()) {
            // Load more via AJAX
            $catalogs = Catalog::active()->ordered()->paginate($perPage);
            return response()->json([
                'html' => view('partials.catalog-cards', compact('catalogs'))->render(),
                'hasMore' => $catalogs->hasMorePages()
            ]);
        }

        $catalogs = Catalog::active()->ordered()->paginate($perPage);
        $featured_catalogs = Catalog::active()->featured()->ordered()->take(4)->get();

        return view('home', compact('catalogs', 'featured_catalogs'));
    }
}
