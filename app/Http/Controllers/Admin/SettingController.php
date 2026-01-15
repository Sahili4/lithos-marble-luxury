<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    /**
     * Display settings page.
     */
    public function index()
    {
        $settings = Setting::orderBy('group')->orderBy('key')->get()->groupBy('group');
        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update settings.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'settings' => 'nullable|array',
            'settings.*' => 'nullable|string|max:1000',
            'images' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle text settings
        if ($request->has('settings')) {
            foreach ($request->settings as $key => $value) {
                $setting = Setting::where('key', $key)->first();
                if ($setting) {
                    $setting->update(['value' => $value]);
                    Cache::forget("setting_{$key}");
                }
            }
        }

        // Handle image settings
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $image) {
                $setting = Setting::where('key', $key)->first();
                if ($setting) {
                    $filename = time() . '_' . $image->getClientOriginalName();
                    $image->move(public_path('assets'), $filename);

                    $setting->update(['value' => 'assets/' . $filename]);
                    Cache::forget("setting_{$key}");
                }
            }
        }

        Cache::forget('all_settings');

        return redirect()->route('admin.settings.index')
            ->with('success', 'Settings updated successfully!');
    }
}
