<?php

namespace App\Livewire\Account;

use App\Models\Profile;
use App\Models\ProfileInvite;
use App\Models\ProfileUsers;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Users extends Component
{
    public $profile;
    public $users;
    public $invitations;
    public $email;

    public function mount(Profile $profile)
    {
        $this->profile = $profile;
    }

    public function render()
    {
        $this->users = $this->profile->profileUsers()->get();
        $this->invitations = $this->profile->invites()->get();
        return view('livewire.account.users');
    }

    public function removeInvitation($id)
    {
        ProfileInvite::find($id)->delete();
        $this->dispatch('user-removed');
    }

    public function removeUser($id)
    {
        $this->profile->profileUsers()->find($id)->delete();
        $this->dispatch('user-removed');
    }

    public function inviteUser()
    {
        $this->validate([
            'email' => [
                'required',
                'email',
                Rule::unique('profile_invites')->where(function ($query){
                    return $query->where('profile_id', $this->profile->id);
                }),
            ],
        ], [
            'email.unique' => __('all.user_already_invited'),
        ]);
        $exists = ProfileUsers::query()->where('profile_id', $this->profile->id)->whereHas('user', function ($query) {
            $query->where('email', $this->email);
        })->exists();

        if ($exists) {
            $this->addError('email', __('all.user_already_has_access'));
            return;
        }

        do {
            $token = Str::random(12);
        } while (ProfileInvite::where('token', $token)->first());

        $invitation = $this->profile->invites()->create([
            'email' => $this->email,
            'token' => $token,
            'user_id' => auth()->id(),
        ]);

        Mail::to($this->email)->send(new \App\Mail\InvitationEmail($invitation));

        $this->dispatch('user-invited');

        $this->reset('email');
    }
}
