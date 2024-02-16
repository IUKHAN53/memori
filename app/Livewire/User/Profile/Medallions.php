<?php

namespace App\Livewire\User\Profile;

use App\Livewire\Forms\ProfileForm;
use App\Models\Profile;
use App\Models\QrCode;
use Livewire\Component;

class Medallions extends Component
{
    public bool $list_screen = true;
    public bool $add_screen = false;
    public bool $editing = false;

    public ProfileForm $form;

    public function showListScreen()
    {
        $this->list_screen = true;
        $this->add_screen = false;
    }

    public function showAddScreen(Profile $profile = null)
    {
        if ($profile) {
            $this->form->setProfile($profile);
            $this->editing = true;
        }
        $this->list_screen = false;
        $this->add_screen = true;
    }


    public function render()
    {
        return view('livewire.user.profile.medallions')->with('profiles', auth()->user()->profiles);
    }

    public function saveProfile()
    {
        if ($this->editing) {
            $this->form->update();
            $this->editing = false;
        } else {
            $this->form->store();
        }
        $this->showListScreen();
    }


    public function deleteProfile(Profile $profile)
    {
        $profile->delete();
    }


}
