<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Profile;
use App\Models\ProfileInvite;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function view($id)
    {
        $profile = Profile::find($id);
        if (!$profile || !$profile->is_public) {
            if(auth()->user()->id !== $profile->user_id && !$profile->is_public) {
                abort(404);
            }
        }
        return view('profile', compact('profile'));
    }

    public function markFavourite(Request $request, $id)
    {
        $profile = Profile::find($id);
        if (auth()->user()->favourites()->where('profile_id', $profile->id)->exists()) {
            auth()->user()->favourites()->where('profile_id', $profile->id)->delete();
        } else {
            auth()->user()->favourites()->create([
                'profile_id' => $profile->id
            ]);
        }
        return redirect()->back();
    }

    public function acceptInvite($token)
    {
        $invite = ProfileInvite::where('token', $token)->first();
        if (!$invite) {
            return response()->json(['message' => 'Invite not found'], 404);
        }
        $invite->accept($token);
        $userExists = User::query()->where('email', $invite->email)->exists();
        if ($userExists) {
            $user = User::query()->where('email', $invite->email)->first();
            $profileUser = $invite->profile->profileUsers()->create([
                'user_id' => $user->id,
                'is_owner' => false,
                'can_edit' => false,
            ]);
            if ($profileUser)
                $invite->delete();
        }
        return redirect()->route('welcome')->with('success', 'Invitation accepted! Login with invited email.');
    }

    public function changeVisibility($id)
    {
        $profile = Profile::find($id);
        $profile->update([
            'is_public' => !$profile->is_public
        ]);
        return redirect()->back();
    }
}
