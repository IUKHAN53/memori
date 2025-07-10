<?php

namespace App\Livewire\Account;

use App\Models\Profile;
use Livewire\Component;

use Livewire\Attributes\On;

class Videos extends Component
{
    public $can_add = false;
    public $profile;
    public $url;
    public $title;
    public $description;

    public function mount(Profile $profile)
    {
        $this->profile = $profile;
        $this->can_add = $profile->canEdit();
    }

    public function render()
    {

        return view('livewire.account.videos')->with('videos', $this->profile->videos()->get());
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
            'url'         => $this->url,
            'title'       => $this->title,
            'description' => $this->description,
            'user_id'     => auth()->id(),
        ]);

        $this->reset(['url', 'title', 'description']);

        $this->dispatch('closeModal');
    }

    public function removeVideo($videoId)
    {
        $video = $this->profile->videos()->find($videoId);
        if ($video) {
            // Check if user can delete this video
            if (!$this->canUserDeleteVideo($video)) {
                session()->flash('error', 'You are not authorized to delete this video.');
                return;
            }
            
            $video->delete();
        }
    }

    /**
     * Check if the current user can delete a specific video (for use in blade template).
     */
    public function canDeleteVideo($video)
    {
        // Allow deletion if: user is profile owner/editor OR user is the original uploader
        return $this->profile->canEdit() || $video->user_id === auth()->id();
    }

    /**
     * Check if the current user can delete a video.
     * Users can delete videos if they are:
     * 1. The profile owner (is_owner = true)
     * 2. The user who uploaded the video
     */
    private function canUserDeleteVideo($video)
    {
        // Allow deletion if: user is profile owner/editor OR user is the original uploader
        return $this->profile->canEdit() || $video->user_id === auth()->id();
    }
}
