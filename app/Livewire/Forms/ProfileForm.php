<?php

namespace App\Livewire\Forms;

use App\Models\Profile;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\WithFileUploads;

class ProfileForm extends Form
{
    #[Validate('required')]
    public $first_name;

    public $middle_name;

    #[Validate('required')]
    public $last_name;

    public $title;
    public $relationship;
    public $picture;
    public $cover_photo;
    public $city;
    public $state;
    public $obituary_link;
    public $bio;
    public $heading_text;
    public $include_heading_text = false;
    public $quote_text;

    #[Validate('required|date|before:today')]
    public $date_of_birth;
    #[Validate('required|date|after:date_of_birth')]
    public $date_of_death;
    public $cemetery_name;
    public $cemetery_plot;
    public $cemetery_city;
    public $cemetery_state;
    public $cemetery_lat;
    public $cemetery_lng;

    public $user_id;

    public $profile;

    public function setProfile(Profile $profile)
    {
        $this->profile = $profile;

        $this->first_name = $profile->first_name;

        $this->middle_name = $profile->middle_name;

        $this->last_name = $profile->last_name;

        $this->title = $profile->title;

        $this->relationship = $profile->relationship;

        $this->picture = $profile->picture;

        $this->cover_photo = $profile->cover_photo;

        $this->city = $profile->city;

        $this->state = $profile->state;

        $this->obituary_link = $profile->obituary_link;

        $this->bio = $profile->bio;

        $this->heading_text = $profile->heading_text;

        $this->include_heading_text = $profile->include_heading_text ?? false;

        $this->quote_text = $profile->quote_text;

        $this->date_of_birth = $profile->date_of_birth;

        $this->date_of_death = $profile->date_of_death;

        $this->cemetery_name = $profile->cemetery_name;

        $this->cemetery_plot = $profile->cemetery_plot;

        $this->cemetery_city = $profile->cemetery_city;

        $this->cemetery_state = $profile->cemetery_state;

        $this->cemetery_lat = $profile->cemetery_lat;

        $this->cemetery_lng = $profile->cemetery_lng;

        $this->user_id = $profile->user_id;
    }


    public function store()
    {
        $this->validate();
        $this->user_id = auth()->id();
        Profile::create($this->except('profile'));
        $this->reset();
    }

    public function update()
    {
        $this->validate();
        $this->profile->update(
            $this->except('profile')
        );
        $this->reset('');
    }

}
