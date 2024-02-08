<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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


    public function assignedQr($value)
    {
        return $this->hasOne(Qr::class)->where('assigned_to', $value);
    }

}
