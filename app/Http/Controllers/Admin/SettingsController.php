<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSettings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $language = SiteSettings::query()->where('key', 'language')->first();
        $textDirection = SiteSettings::query()->where('key', 'text_direction')->first();
        return view('admin.settings.index', compact('language', 'textDirection'));
    }

    public function update(Request $request)
    {
        SiteSettings::updateOrCreate(['key' => 'language'], ['value' => $request->get('language')]);
        SiteSettings::updateOrCreate(['key' => 'text_direction'], ['value' => $request->get('text_direction')]);
        return redirect()->back()->with('success', 'Settings updated successfully');
    }
}
