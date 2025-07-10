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
    public $can_add = false;

    public function mount(Profile $profile)
    {
        $this->profile = $profile;
        $this->can_add = $profile->canEdit();
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
        // Check if user has permission to post tributes
        if (!$this->profile->canEdit()) {
            session()->flash('error', 'You do not have permission to post tributes.');
            return;
        }
        
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
        
        // Check if user has permission to remove tributes
        // Allow removal if: user is profile owner/editor OR user is the original tribute author
        if (!$this->profile->canEdit() && $tribute->user_id !== auth()->id()) {
            session()->flash('error', 'You do not have permission to remove this tribute.');
            return;
        }
        
        $tribute->delete();
        session()->flash('success', 'Tribute removed successfully.');
    }

    public function canDeleteTribute($tribute)
    {
        // Allow deletion if: user is profile owner/editor OR user is the original tribute author
        return $this->profile->canEdit() || $tribute->user_id === auth()->id();
    }
}
