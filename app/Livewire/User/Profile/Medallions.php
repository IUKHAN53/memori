<?php

namespace App\Livewire\User\Profile;

use App\Livewire\Forms\ProfileForm;
use App\Models\Profile;
use App\Models\QrCode;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Medallions extends Component
{
    use WithFileUploads;

    public bool $list_screen = true;
    public bool $add_screen = false;
    public bool $editing = false;

    public $picture;
    public $profile_picture = null;

    public ProfileForm $form;

    public function showListScreen()
    {
        $this->list_screen = true;
        $this->add_screen = false;
    }

    public function showAddScreen($profile = null)
    {
        if ($profile) {
            $existing = Profile::find($profile);
            $this->form->setProfile($existing);
            $this->profile_picture = $existing->profile_picture;
            $this->editing = true;
        } else {
            $this->form->reset();
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
        if ($this->picture) {
            $filename = Str::slug($this->picture->getClientOriginalName()) . '-' . time() . '.' . $this->picture->getClientOriginalExtension();
            $file_path = $this->picture->storeAs('profile_picture', $filename, 'public');
            $this->form->picture = $file_path;
        }
        if ($this->editing) {
            $this->form->update();
            $this->editing = false;
        } else {
            $this->form->store();
        }
        $this->reset('picture', 'profile_picture');
        $this->showListScreen();
    }


    public function deleteProfile(Profile $profile)
    {
        $profile->delete();
    }

    /**
     * @throws \Exception
     */
    public function assignQrCode(Profile $profile)
    {
        $user_qr_code = auth()->user()->QrCodeUsers->first();
        if ($user_qr_code) {
            $qr_code = $user_qr_code->qrCode;
            $qr_code->assignTo($profile);
            $user_qr_code->delete();
        }
    }
}
