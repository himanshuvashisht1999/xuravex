<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function edit()
    {
        $admin = auth('admin')->user();
        return view('admin.profile.edit', compact('admin'));
    }

    public function update(Request $request)
    {
        $admin = auth('admin')->user();

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,email,' . $admin->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];

        // Only validate password if user wants to change it
        if ($request->filled('password')) {
            $rules['current_password'] = 'required|current_password:admin';
            $rules['password'] = ['required', 'confirmed', Password::defaults()];
        }

        $request->validate($rules);

        if ($request->hasFile('image')) {
            $imageName = 'admin_' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/admins'), $imageName);
            $admin->image = $imageName;
        }

        $admin->name = $request->name;
        $admin->email = $request->email;

        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        $admin->save();

        return back()->with('success', 'Profile updated successfully!');
    }
}
