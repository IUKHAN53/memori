<?php

namespace App\Livewire\Account;

use App\Models\Profile;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class Photos extends Component
{
    use withFileUploads;

    public $can_add = false;
    public $profile;
    public $photo;
    public $caption;
    public $photos;
    public $field;

    public function mount(Profile $profile)
    {
        $this->profile = $profile;
        $this->can_add = $profile->user_id === auth()->id();

        $this->field = [
            'name' => 'image',
            'label' => 'Upload Image',
            'key' => 'image',
            'id' => 'imageCropper',
            'width' => 400,
            'height' => 400,
            'shape' => 'square',
            'wrapperClass' => 'w-50',
            'thumbnail' => '',
            'disabled' => false,
        ];
    }

    public function render()
    {
        $this->photos = $this->profile->photos;
        return view('livewire.account.photos');
    }

    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|max:4096', // 1MB Max
        ]);
    }

    public function addPhoto()
    {
        $path = $this->photo->store('profile/photos', 'public');
        $this->profile->photos()->create([
            'path' => $path,
            'caption' => $this->caption,
        ]);
        $this->photo = null;
        $this->caption = '';
        $this->photos = $this->profile->photos;
    }

    public function removePhoto($photoId)
    {
        $photo = $this->profile->photos()->where('id', $photoId)->first();
        $photo->delete();
        $this->photos = $this->profile->photos;
    }
    #[On('savePhoto')]
    public function savePhoto($image)
    {
        $this->validate([
            'caption' => 'required|string|max:255',
        ]);
        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image));
        $fileName = 'profiles/photo-' . time() . '.png';
        Storage::disk('public')->put($fileName, $imageData, 'public');
        $this->profile->photos()->create([
            'path' => $fileName,
            'caption' => $this->caption,
        ]);
        $this->photo = null;
        $this->caption = '';
        $this->photos = $this->profile->photos;
    }

}
