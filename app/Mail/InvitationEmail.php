<?php

namespace App\Mail;

use App\Models\ProfileInvite;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvitationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $invite;
    public $username;
    public $email;
    public $action_url;

    public function __construct(ProfileInvite $invite)
    {
        $this->invite = $invite;
        $this->username = $invite->profile->user->name;
        $this->email = $invite->email;
        $this->action_url = route('profile.invite.accept', $invite->token);
    }

    public function build()
    {
        return $this->view('emails.invitation');
    }
}
