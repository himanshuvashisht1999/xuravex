<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->except('_token');

        // Handle File Uploads (Logo, Favicon)
        if ($request->hasFile('site_logo')) {
            $logoName = 'logo_' . time() . '.' . $request->site_logo->extension();
            $request->site_logo->move(public_path('uploads/settings'), $logoName);
            $data['site_logo'] = $logoName;
        }

        if ($request->hasFile('site_favicon')) {
            $faviconName = 'favicon_' . time() . '.' . $request->site_favicon->extension();
            $request->site_favicon->move(public_path('uploads/settings'), $faviconName);
            $data['site_favicon'] = $faviconName;
        }

        foreach ($data as $key => $value) {
            Setting::set($key, $value);
        }

        return back()->with('success', 'Settings updated successfully!');
    }
}
