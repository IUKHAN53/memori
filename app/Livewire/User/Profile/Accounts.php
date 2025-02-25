<?php

namespace App\Livewire\User\Profile;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Accounts extends Component
{
    public $user;
    public $current_password;
    public $password;
    public $password_confirmation;

    public $first_name;
    public $last_name;
    public $city;
    public $country;
    public function mount()
    {
        $this->user = auth()->user();
        $this->first_name = $this->user->first_name;
        $this->last_name = $this->user->last_name;
        $this->city = $this->user->city;
        $this->country = $this->user->country;
    }
    public function render()
    {
        return view('livewire.user.profile.accounts');
    }

    public function updatePassword(): void
    {
        try {
            $validated = $this->validate([
                'current_password' => ['required', 'string', 'current_password'],
                'password' => ['required', 'string', Password::defaults(), 'confirmed'],
            ]);
        } catch (ValidationException $e) {
            $this->reset('current_password', 'password', 'password_confirmation');
            throw $e;
        }

        Auth::user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        $this->reset('current_password', 'password', 'password_confirmation');

        $this->dispatch('password-updated');
    }

    public function updateProfile(): void
    {
        $this->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
        ]);

        $this->user->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'city' => $this->city,
            'country' => $this->country,
        ]);
        $this->dispatch('profile-updated');

    }
}
