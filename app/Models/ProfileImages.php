<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Usamamuneerchaudhary\Commentify\Traits\Commentable;

class ProfileImages extends Model
{
    use HasFactory;
    use Commentable;

    protected $fillable = [
        'profile_id',
        'path',
        'caption',
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function getImageAttribute($value)
    {
        return $this->path ? Storage::url($this->path) : 'https://ui-avatars.com/api/?name=' . urlencode($this->caption) . '&color=7F9CF5&background=EBF4FF';
    }


}
