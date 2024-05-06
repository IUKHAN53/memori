<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileInvite extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_id',
        'email',
        'token',
        'user_id',
        'is_accepted',
        'accepted_at',
        'expires_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'accepted_at' => 'datetime',
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }

    public function isExpired()
    {
        return now()->greaterThan($this->expires_at);
    }

    public function isAccepted()
    {
        return $this->is_accepted;
    }

    public function accept($token)
    {
        if (!$invite = ProfileInvite::where('token', $token)->first()) {
            abort(404);
        }else{
            $invite->update([
                'is_accepted' => true,
                'accepted_at' => now(),
            ]);
        }
    }

    public function isPending()
    {
        return !$this->isAccepted() && !$this->isExpired();
    }

    public function isDeclined()
    {
        return !$this->isAccepted() && $this->isExpired();
    }

}
