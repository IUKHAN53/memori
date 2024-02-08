<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    /**
     * Display a listing of the profiles.
     */
    public function index()
    {
        $profiles = Profile::all();
        return view('admin.profiles.index', compact('profiles'));
    }

    /**
     * Show the form for creating a new profile.
     */
    public function create()
    {
        return view('admin.profiles.create');
    }

    /**
     * Store a newly created profile in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            // Validation rules
        ]);

        Profile::create($validatedData);

        return redirect()->route('admin.profiles.index')->with('success', 'Profile created successfully.');
    }

    /**
     * Display the specified profile.
     */
    public function show(Profile $profile)
    {
        return view('admin.profiles.show', compact('profile'));
    }

    /**
     * Show the form for editing the specified profile.
     */
    public function edit(Profile $profile)
    {
        return view('admin.profiles.edit', compact('profile'));
    }

    /**
     * Update the specified profile in storage.
     */
    public function update(Request $request, Profile $profile)
    {
        $validatedData = $request->validate([
            // Validation rules
        ]);

        $profile->update($validatedData);

        return redirect()->route('admin.profiles.index')->with('success', 'Profile updated successfully.');
    }

    /**
     * Remove the specified profile from storage.
     */
    public function destroy(Profile $profile)
    {
        $profile->delete();

        return redirect()->route('admin.profiles.index')->with('success', 'Profile deleted successfully.');
    }
}
