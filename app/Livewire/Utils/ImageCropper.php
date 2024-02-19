<?php

namespace App\Livewire\Utils;

use Livewire\Component;

class ImageCropper extends Component
{
    public $field;

    public function mount(){
        $this->field = [
            'name' => 'image',
            'label' => __('tf::form.cropper.label'),
            'key' => 'image',
            'id' => 'imageCropper',
            'width' => 250,
            'height' => 250,
            'shape' => 'circle',
            'wrapperClass' => 'w-50',
            'thumbnail' => 'tf-cropper-thumb',
            'disabled' => false,
        ];
    }

    public function render()
    {
        return view('livewire.utils.image-cropper');
    }
}
