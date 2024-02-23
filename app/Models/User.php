<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Usamamuneerchaudhary\Commentify\Traits\HasUserAvatar;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
//    use HasUserAvatar;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'city',
        'country',
        'email',
        'password',
        'role',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function profiles()
    {
        return $this->hasMany(Profile::class);
    }

    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getPictureAttribute()
    {
        return $this->avatar ? Storage::url($this->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=7F9CF5&background=EBF4FF';
    }

    public function QrCodeUsers()
    {
        return $this->hasMany(QrCodeUser::class);
    }

    public function hasQRCodes()
    {
        $this->QrCodeUsers()->exists();
    }

    public function favourites()
    {
        return $this->hasMany(Favourites::class);
    }

    public function hasFavourited($profile)
    {
        return $this->favourites()->where('profile_id', $profile->id)->exists();
    }

    public function tributes()
    {
        return $this->hasMany(ProfileTributes::class);
    }
}
