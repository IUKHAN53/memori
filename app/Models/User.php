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

    protected static function booted()
    {
        static::created(function ($user) {
            $invitationExists = ProfileInvite::where('email', $user->email)->where('is_accepted', true)->exists();
            if ($invitationExists) {
                $invitations = ProfileInvite::where('email', $user->email)->where('is_accepted', true)->get();
                foreach ($invitations as $invitation) {
                    ProfileUsers::create([
                        'profile_id' => $invitation->profile_id,
                        'user_id' => $user->id,
                        'is_owner' => false,
                        'can_edit' => false,
                    ]);
                    $invitation->delete();
                }
            }
        });
    }

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
        return $this->QrCodeUsers()->whereHas('qrCode', function ($q) {
            $q->where('is_assigned', false);
        })->exists();
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

    public function tributeLikes()
    {
        return $this->hasMany(TributeLikes::class);
    }

    public function hasLiked($tribute_id)
    {
        return $this->tributeLikes()->where('tribute_id', $tribute_id)->exists();
    }
}
