<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileVideos extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_id',
        'url',
        'title',
        'description',
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function getEmbedUrlAttribute()
    {
        $videoId = null;
        if (str_contains($this->url, 'youtu.be')) {
            $parts = explode('/', $this->url);
            $videoId = end($parts); // Gets the last part of the URL
        }
        elseif (str_contains($this->url, 'youtube.com/watch?v=')) {
            parse_str(parse_url($this->url, PHP_URL_QUERY), $queryParts);
            $videoId = $queryParts['v'] ?? null;
        }
        elseif (str_contains($this->url, 'youtube.com/embed/')) {
            $parts = explode('/', parse_url($this->url, PHP_URL_PATH));
            $videoId = end($parts);
        }
        return $videoId ? "https://www.youtube.com/embed/$videoId" : null;
    }

}
