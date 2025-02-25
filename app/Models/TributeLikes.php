<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TributeLikes extends Model
{
    use HasFactory;

    protected $fillable = ['tribute_id', 'user_id'];

    public function tribute()
    {
        return $this->belongsTo(ProfileTributes::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeUserLiked($query, $tributeId, $userId)
    {
        return $query->where('tribute_id', $tributeId)->where('user_id', $userId);
    }

    public function scopeTributeLikes($query, $tributeId)
    {
        return $query->where('tribute_id', $tributeId);
    }


}
