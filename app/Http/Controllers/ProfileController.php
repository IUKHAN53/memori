<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function view($id)
    {
        $profile = Profile::find($id);
        if (!$profile) {
            return response()->json(['message' => 'Profile not found'], 404);
        }
        return view('profile', compact('profile'));
    }

    public function markFavourite(Request $request, $id)
    {
        $profile = Profile::find($id);
        if (auth()->user()->favourites()->where('profile_id', $profile->id)->exists()) {
            auth()->user()->favourites()->where('profile_id', $profile->id)->delete();
        }else{
            auth()->user()->favourites()->create([
                'profile_id' => $profile->id
            ]);
        }
        return redirect()->back();
    }
}
