<?php

namespace App\Livewire\User\Profile;

use Livewire\Component;

class Posts extends Component
{

    public $posts;


    public function render()
    {
        $this->posts = auth()->user()->tributes()->latest()->get();
        return view('livewire.user.profile.posts');
    }
}
