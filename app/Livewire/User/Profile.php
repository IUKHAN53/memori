<?php

namespace App\Livewire\User;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Profile extends Component
{
    protected $listeners = ['saveProfileImage'];

    public function render()
    {
        return view('livewire.user.profile');
    }

    public $field;
    public $profileImage;

    public function mount()
    {
        $this->field = [
            'name' => 'image',
            'label' => 'Upload Image',
            'key' => 'image',
            'id' => 'imageCropper',
            'width' => 250,
            'height' => 250,
            'shape' => 'circle',
            'wrapperClass' => 'w-50',
            'thumbnail' => '',
            'disabled' => false,
        ];
    }


    public function saveProfileImage()
    {
        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $this->profileImage));
        $fileName = 'avatars/profile-image-' . time() . '.png';
        Storage::disk('public')->put($fileName, $imageData, 'public');
        $user = auth()->user();
        $user->update([
            'avatar' => $fileName
        ]);

    }

}
