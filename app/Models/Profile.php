<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Matrix\Decomposition\QR;

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
        'city',
        'state',
        'obituary_link',
        'bio',
        'heading_text',
        'include_heading_text',
        'quote_text',
        'date_of_birth',
        'date_of_death',
        'user_id',
    ];

    protected $appends = ['full_name'];
    protected $casts = [
        'date_of_birth' => 'date',
        'date_of_death' => 'date',
    ];

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

}
