<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Usamamuneerchaudhary\Commentify\Traits\Commentable;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'title',
        'relationship',
        'picture',
        'cover_photo',
        'city',
        'state',
        'obituary_link',
        'bio',
        'heading_text',
        'include_heading_text',
        'quote_text',
        'date_of_birth',
        'date_of_death',
        'cemetery_name',
        'cemetery_plot',
        'cemetery_city',
        'cemetery_state',
        'cemetery_lat',
        'cemetery_lng',
        'user_id',
        'is_public',
    ];

    protected $appends = ['full_name'];
    protected $casts = [
        'date_of_birth' => 'date',
        'date_of_death' => 'date',
    ];

    protected static function booted()
    {
        static::created(function ($profile) {
            ProfileUsers::create([
                'profile_id' => $profile->id,
                'user_id' => $profile->user_id,
                'is_owner' => true,
                'can_edit' => true,
            ]);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->middle_name . ' ' . $this->last_name;
    }


    public function assignedQr()
    {
        return $this->hasOne(QrCode::class, 'profile_id', 'id');
    }

    public function qr_code()
    {
        return $this->hasOne(QrCode::class);
    }

    public function getProfilePictureAttribute()
    {
        return $this->picture ? Storage::url($this->picture) : 'https://ui-avatars.com/api/?name=' . urlencode($this->full_name) . '&color=7F9CF5&background=EBF4FF';
    }

    public function getCoverAttribute()
    {
        return $this->cover_photo ? Storage::url($this->cover_photo) : 'https://ui-avatars.com/api/?name=' . urlencode($this->full_name) . '&color=7F9CF5&background=EBF4FF';
    }

    public function getAgeAttribute()
    {
        return $this->date_of_death->diffInYears($this->date_of_birth);
    }

    public function getCemeteryAddressAttribute()
    {
        return $this->cemetery_name . ', ' . $this->cemetery_plot . ', ' . $this->cemetery_city . ', ' . $this->cemetery_state;
    }

    public function photos()
    {
        return $this->hasMany(ProfileImages::class);
    }

    public function videos()
    {
        return $this->hasMany(ProfileVideos::class);
    }

    public function tributes()
    {
        return $this->hasMany(ProfileTributes::class);
    }

    public function invites()
    {
        return $this->hasMany(ProfileInvite::class);
    }

    public function profileUsers()
    {
        return $this->hasMany(ProfileUsers::class);
    }

    public function canEdit()
    {
        return $this->profileUsers()->where('user_id', auth()->id())->where('can_edit', true)->exists();
    }

}
