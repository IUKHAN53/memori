<?php

namespace App\Livewire\Account;

use App\Models\Profile;
use App\Models\ProfileTributes;
use App\Models\TributeLikes;
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
        $exist = TributeLikes::query()->where('tribute_id', $tributeId)->where('user_id', auth()->id());
        if ($exist->exists()) {
            $exist->delete();
            $tribute->likes = $tribute->likes - 1;
        } else {
            $like = new TributeLikes();
            $like->tribute_id = $tributeId;
            $like->user_id = auth()->id();
            $like->save();
            $tribute->likes = $tribute->likes + 1;
        }
        $tribute->save();
    }

    public function removeTribute($tributeId)
    {
        $tribute = ProfileTributes::find($tributeId);
        $tribute->delete();
    }
}
