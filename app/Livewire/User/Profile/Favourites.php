<?php

namespace App\Livewire\User\Profile;

use Livewire\Component;

class Favourites extends Component
{
    public $favourites;
    public $profile_url;
    public function mount()
    {
        $this->favourites = auth()->user()->favourites()->with('profile')->get();
    }

    public function render()
    {
        return view('livewire.user.profile.favourites');
    }

    public function removeFavourite($favouriteId)
    {
        \App\Models\Favourites::query()->where('id', $favouriteId)->delete();
        $this->favourites = auth()->user()->favourites()->with('profile')->get();
    }


    public function createLinks($profileId)
    {
        $profile = \App\Models\Profile::query()->where('id', $profileId)->first();
        $profile_url = route('profile.show', $profile->id);
    }
}
