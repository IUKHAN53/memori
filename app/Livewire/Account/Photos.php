<?php

namespace App\Livewire\Account;

use App\Models\Profile;
use Livewire\Component;
use Livewire\WithFileUploads;

class Photos extends Component
{
    use withFileUploads;
    public $can_add = false;
    public $profile;
    public $photo;
    public $caption;
    public $photos;

    public function mount(Profile $profile)
    {
        $this->profile = $profile;
        $this->can_add = $profile->user_id === auth()->id();
    }
    public function render()
    {
        $this->photos = $this->profile->photos;
        return view('livewire.account.photos');
    }

    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|max:4096', // 1MB Max
        ]);
    }

    public function addPhoto()
    {
        $this->validate([
            'photo' => 'required|image|max:4096', // 1MB Max
            'caption' => 'required|string|max:255',
        ]);
        $path = $this->photo->store('profile/photos', 'public');
        $this->profile->photos()->create([
            'path' => $path,
            'caption' => $this->caption,
        ]);
        $this->photo = null;
        $this->caption = '';
        $this->photos = $this->profile->photos;
    }


}
