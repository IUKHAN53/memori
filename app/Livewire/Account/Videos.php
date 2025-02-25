<?php

namespace App\Livewire\Account;

use App\Models\Profile;
use Livewire\Component;

class Videos extends Component
{
    public $can_add = false;
    public $profile;
    public $url;
    public $title;
    public $description;
    public $videos;

    public function mount(Profile $profile)
    {
        $this->profile = $profile;
        $this->can_add = $profile->canEdit();
        // Initial load of videos (ensure it's a fresh query)
        $this->videos = $this->profile->videos()->get();
    }

    public function render()
    {
        // Re-query the videos on each render to reflect any changes
        $this->videos = $this->profile->videos()->get();
        return view('livewire.account.videos');
    }

    protected $rules = [
        'url'         => 'required|url|starts_with:https://www.youtube.com/,https://youtu.be/',
        'title'       => 'required|string|max:255',
        'description' => 'nullable|string|max:1000',
    ];

    public function addVideo()
    {
        $this->validate();

        $this->profile->videos()->create([
            'url'         => $this->url,
            'title'       => $this->title,
            'description' => $this->description,
        ]);

        // Re-query videos after adding new one
        $this->videos = $this->profile->videos()->get();

        // Reset form fields
        $this->reset(['url', 'title', 'description']);
    }

    public function removeVideo($videoId)
    {
        $video = $this->profile->videos()->find($videoId);
        if ($video) {
            $video->delete();
        }
        // Re-query videos after deletion
        $this->videos = $this->profile->videos()->get();
    }
}
