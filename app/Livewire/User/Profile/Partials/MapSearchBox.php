<?php

namespace App\Livewire\User\Profile\Partials;

use Livewire\Component;

class MapSearchBox extends Component
{
    public $latitude;
    public $longitude;


    public function mount($lat, $lng)
    {
        $this->latitude = $lat;
        $this->longitude = $lng;
    }

    public function setCoordinates()
    {

        $this->dispatch('setCoordinates', [
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ])->to('user.profile.medallions');
    }

    public function confirmAndClose()
    {
    }

    public function render()
    {
        return view('livewire.user.profile.partials.map-search-box');
    }
}
