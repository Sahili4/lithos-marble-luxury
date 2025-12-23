<?php

namespace App\Http\Controllers\Admin;

use App\Models\Catalog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CatalogController extends Controller
{
    /**
     * Display a listing of catalogs.
     */
    public function index()
    {
        $catalogs = Catalog::ordered()->paginate(10);
        return view('admin.catalogs.index', compact('catalogs'));
    }

    /**
     * Show the form for creating a new catalog.
     */
    public function create()
    {
        return view('admin.catalogs.create');
    }

    /**
     * Store a newly created catalog in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'origin' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'type' => 'nullable|string|max:255',
            'application' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
            'sort_order' => 'nullable|integer',
            'status' => 'boolean',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('catalogs', $filename, 'public');
            $validated['image'] = 'storage/' . $path;
        }

        Catalog::create($validated);

        return redirect()->route('admin.catalogs.index')
            ->with('success', 'Catalog item created successfully!');
    }

    /**
     * Show the form for editing the specified catalog.
     */
    public function edit(Catalog $catalog)
    {
        return view('admin.catalogs.edit', compact('catalog'));
    }

    /**
     * Update the specified catalog in storage.
     */
    public function update(Request $request, Catalog $catalog)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'origin' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'type' => 'nullable|string|max:255',
            'application' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
            'sort_order' => 'nullable|integer',
            'status' => 'boolean',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($catalog->image && file_exists(public_path($catalog->image))) {
                unlink(public_path($catalog->image));
            }

            $image = $request->file('image');
            $filename = time() . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('catalogs', $filename, 'public');
            $validated['image'] = 'storage/' . $path;
        }

        $catalog->update($validated);

        return redirect()->route('admin.catalogs.index')
            ->with('success', 'Catalog item updated successfully!');
    }

    /**
     * Remove the specified catalog from storage.
     */
    public function destroy(Catalog $catalog)
    {
        // Delete image
        if ($catalog->image && file_exists(public_path($catalog->image))) {
            unlink(public_path($catalog->image));
        }

        $catalog->delete();

        return redirect()->route('admin.catalogs.index')
            ->with('success', 'Catalog item deleted successfully!');
    }
}
