<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Usamamuneerchaudhary\Commentify\Traits\Commentable;

class ProfileTributes extends Model
{
    use HasFactory;
    use Commentable;

    protected $fillable = [
        'profile_id',
        'tribute',
        'likes',
        'user_id',
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
