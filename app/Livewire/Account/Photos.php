<?php

namespace App\Livewire\Account;

use App\Models\Profile;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class Photos extends Component
{
    use WithFileUploads;

    public $can_add = false;
    public $profile;
    public $photo;
    public $caption;
    public $photos;
    public $field;

    public function mount(Profile $profile)
    {
        $this->profile = $profile;
        $this->can_add = $profile->canEdit();

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
        // Load fresh photos
        $this->photos = $this->profile->photos()->get();
    }

    public function render()
    {
        // Always re-query to reflect recent changes (e.g. deletion)
        $this->photos = $this->profile->photos()->get();
        return view('livewire.account.photos');
    }

    /**
     * Check if the current user can delete a specific photo (for use in blade template).
     */
    public function canDeletePhoto($photo)
    {
        // Allow deletion if: user is profile owner/editor OR user is the original uploader
        return $this->profile->canEdit() || $photo->user_id === auth()->id();
    }

    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|mimes:jpg,jpeg,png,gif|max:4096', // limit to supported file types
        ]);
    }

    public function addPhoto()
    {
        // Validate both photo and caption
        $this->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png,gif|max:4096',
            'caption' => 'required|string|max:255',
        ]);

        $path = $this->photo->store('profile/photos', 'public');
        $this->profile->photos()->create([
            'path' => $path,
            'caption' => $this->caption,
            'user_id' => auth()->id(),
        ]);

        // Refresh photos so that the delete buttons show correctly
        $this->photos = $this->profile->photos()->get();
        $this->reset(['photo', 'caption']);
    }

    public function removePhoto($photoId)
    {
        $photo = $this->profile->photos()->find($photoId);
        if ($photo) {
            // Check if user can delete this photo
            if (!$this->canUserDeletePhoto($photo)) {
                session()->flash('error', 'You are not authorized to delete this photo.');
                return;
            }
            
            if (Storage::disk('public')->exists($photo->path)) {
                Storage::disk('public')->delete($photo->path);
            }
            $photo->delete();
        }
        // Re-query photos after deletion
        $this->photos = $this->profile->photos()->get();
        return redirect()->to(request()->header('Referer'));
    }

    #[On('savePhoto')]
    public function savePhoto($image)
    {
        // Validate caption here as well (required for cropped uploads)
        $this->validate([
            'caption' => 'required|string|max:255',
        ]);
        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image));
        $fileName = 'profiles/photo-' . time() . '.png';
        Storage::disk('public')->put($fileName, $imageData, 'public');
        $this->profile->photos()->create([
            'path' => $fileName,
            'caption' => $this->caption,
            'user_id' => auth()->id(),
        ]);
        $this->photos = $this->profile->photos()->get();
        return redirect()->to(request()->header('Referer'));
    }

    /**
     * Check if the current user can delete a photo.
     * Users can delete photos if they are:
     * 1. The profile owner or have edit permissions
     * 2. The user who uploaded the photo
     */
    private function canUserDeletePhoto($photo)
    {
        // Allow deletion if: user is profile owner/editor OR user is the original uploader
        return $this->profile->canEdit() || $photo->user_id === auth()->id();
    }
}
