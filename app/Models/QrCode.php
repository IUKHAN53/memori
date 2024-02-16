<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class QrCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'identifier',
        'secret_phrase',
        'profile_id',
        'path',
        'is_assigned',
        'assigned_at',
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function assignTo($profile)
    {
        $this->profile_id = $profile->id;
        $this->is_assigned = true;
        $this->assigned_at = now();
        $this->save();
    }

    public function getImageAttribute()
    {
        return Storage::url($this->path);
    }
}
