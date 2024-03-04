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
        $this->can_add = $profile->user_id === auth()->id();
    }

    public function render()
    {
        $this->videos = $this->profile->videos;
        return view('livewire.account.videos');
    }

    protected $rules = [
        'url' => 'required|url|starts_with:https://www.youtube.com/,https://youtu.be/',
        'title' => 'required|string|max:255',
        'description' => 'nullable|string|max:1000',
    ];

    public function addVideo()
    {
        $this->validate();

        $this->profile->videos()->create([
            'url' => $this->url,
            'title' => $this->title,
            'description' => $this->description,
        ]);

        $this->reset(['url', 'title', 'description']);
    }

    public function removeVideo($videoId)
    {
        $video = $this->profile->videos()->where('id', $videoId)->first();
        $video->delete();
        $this->videos = $this->profile->videos;
    }
}
