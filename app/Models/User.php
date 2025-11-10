<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = ["name", "email", "password", 'profile_photo_path'];

    protected $appends = ['status'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = ["password", "remember_token"];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            "email_verified_at" => "datetime",
            "password" => "hashed",
        ];
    }

    /**
     * Mendapatkan URL foto profil pengguna.
     *
     * @return string|null
     */
    public function getProfilePhotoUrlAttribute()
    {
        if ($this->profile_photo_path) {
            if (Storage::disk("public")->exists($this->profile_photo_path)) {
                return Storage::url($this->profile_photo_path);
            }
        }

        return null;
    }

    public function closings(): HasMany
    {
        return $this->hasMany(Closing::class);
    }

    public function getStatusAttribute()
    {
        return $this->is_active ? 'Aktif' : 'Tidak Aktif';
    }

    public function poinRequestsMade(): HasMany
    {
        return $this->hasMany(PoinRequest::class, 'requester_id');
    }

    public function poinRequestsAbout(): HasMany
    {
        return $this->hasMany(PoinRequest::class, 'user_id');
    }
}
