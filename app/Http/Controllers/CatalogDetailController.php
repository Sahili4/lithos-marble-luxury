<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use Illuminate\Http\Request;

class CatalogDetailController extends Controller
{
    /**
     * Display catalog detail page.
     */
    public function show($slug)
    {
        $catalog = Catalog::where('slug', $slug)->where('status', true)->firstOrFail();
        $related_catalogs = Catalog::where('status', true)
            ->where('id', '!=', $catalog->id)
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('catalog-detail', compact('catalog', 'related_catalogs'));
    }
}
