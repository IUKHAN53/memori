<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileUsers extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_id',
        'user_id',
        'is_owner',
        'can_edit',
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
