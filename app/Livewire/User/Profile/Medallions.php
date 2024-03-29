<?php

namespace App\Livewire\User\Profile;

use App\Livewire\Forms\ProfileForm;
use App\Models\Profile;
use App\Models\QrCode;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Medallions extends Component
{
    use WithFileUploads;

    public bool $list_screen = true;
    public bool $add_screen = false;
    public bool $editing = false;

    public $profile_picture;
    public $cover_photo;
    public $profile_picture_changed = false;
    public $cover_photo_changed = false;
    public ProfileForm $form;
    public $field1;
    public $field2;

    public $lat = -25.344;
    public $lng = 131.031;
    public $cemetery_plot_location;

//    protected $listeners = ['saveProfileImage', 'saveCoverPhoto'];

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
            $this->profile_picture = $existing->profile_picture ?? $this->getPlaceholderImage('profile_picture');
            $this->cover_photo = $existing->cover ?? $this->getPlaceholderImage('cover_photo');
            $this->lat = $existing->cemetery_lat;
            $this->lng = $existing->cemetery_lng;
            $this->cemetery_plot_location = 'latitude: '. $this->lat . ', longitude: ' . $this->lng;
            $this->editing = true;
        } else {
            $this->profile_picture = $this->getPlaceholderImage('profile_picture');
            $this->cover_photo = $this->getPlaceholderImage('cover_photo');
            $this->form->reset();
        }
        $this->list_screen = false;
        $this->add_screen = true;
        $this->reset('profile_picture_changed', 'cover_photo_changed');
    }


    public function render()
    {
        return view('livewire.user.profile.medallions')->with('profiles', auth()->user()->profiles);
    }

    public function saveProfile()
    {
        if ($this->profile_picture_changed ) {
            $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $this->profile_picture));
            $fileName = 'profiles/avatars/profile-image-' . time() . '.png';
            Storage::disk('public')->put($fileName, $imageData, 'public');
            $this->form->picture = $fileName;
        }
        if ($this->cover_photo_changed) {
            $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $this->cover_photo));
            $fileName = 'profiles/covers/profile-cover-' . time() . '.png';
            Storage::disk('public')->put($fileName, $imageData, 'public');
            $this->form->cover_photo = $fileName;
        }
        if ($this->editing) {
            $this->form->update();
            $this->editing = false;
        } else {
            $this->form->store();
        }
        $this->reset('cover_photo', 'profile_picture');
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

    public function mount()
    {
        $this->field1 = [
            'name' => 'image',
            'label' => 'Upload Image',
            'key' => 'image',
            'id' => 'imageCropper2',
            'width' => 250,
            'height' => 250,
            'shape' => 'circle',
            'wrapperClass' => 'w-50',
            'thumbnail' => '',
            'disabled' => false,
        ];

        $this->field2 = [
            'name' => 'image',
            'label' => 'Upload Image',
            'key' => 'image',
            'id' => 'imageCropper2',
            'width' => 400,
            'height' => 120,
            'shape' => 'square',
            'wrapperClass' => 'w-50',
            'thumbnail' => '',
            'disabled' => false,
        ];

        $this->profile_picture = $this->getPlaceholderImage('profile_picture');
        $this->cover_photo = $this->getPlaceholderImage('cover_photo');
    }

    #[On('saveProfilePhoto')]
    public function saveProfilePhoto($image)
    {
        $this->profile_picture = $image;
    }

    #[On('saveCoverPhoto')]
    public function saveCoverPhoto($image)
    {
        $this->cover_photo = $image;
    }

    #[On('setCoordinates')]
    public function setCoordinates($coordinates)
    {
        $this->lat = $coordinates['latitude'];
        $this->lng = $coordinates['longitude'];
        $this->form->cemetery_lat = $this->lat;
        $this->form->cemetery_lng = $this->lng;
        $this->cemetery_plot_location = 'latitude: '. $this->lat . ', longitude: ' . $this->lng;
    }

    private function getPlaceholderImage(string $string)
    {
        if ($string === 'profile_picture') {
            return asset('assets/images/avatar-1.png');
        }
        return asset('assets/images/auth-bg.jpg');
    }
}
