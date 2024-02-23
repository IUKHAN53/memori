<?php

namespace App\Livewire\Account;

use App\Models\Profile;
use App\Models\ProfileTributes;
use Livewire\Component;

class Tributes extends Component
{
    public $title;
    public $tribute;
    public $profile;
    public $tributes;

    public function mount(Profile $profile)
    {
        $this->profile = $profile;
    }

    protected $rules = [
        'title' => 'required|string|max:255',
        'tribute' => 'required|string',
    ];
    public function render()
    {
        $this->tributes = $this->profile->tributes()->latest()->get();
        return view('livewire.account.tributes');
    }

    public function postTribute()
    {
        $this->validate();

        $tribute = new ProfileTributes();
        $tribute->user_id = auth()->id();
        $tribute->title = $this->title;
        $tribute->tribute = $this->tribute;
        $tribute->profile_id = $this->profile->id;
        $tribute->save();

        $this->reset(['title', 'tribute']);

    }

    public function toggleLike($tributeId)
    {
        $tribute = ProfileTributes::find($tributeId);
        $tribute->likes++;
        $tribute->save();
    }
}
