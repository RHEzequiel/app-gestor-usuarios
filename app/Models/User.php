<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'phone',
        'professional_url',
        'photo_path',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
        ];
    }

    /**
     * Verifica si el usuario es administrador.
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->is_admin === true;
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    /**
     * Get WhatsApp URL for the user's phone
     */
    public function whatsappUrl(): ?string
    {
        if (!$this->phone) {
            return null;
        }

        $countryPrefix = config('app.whatsapp_country_prefix', '54');
        $phone = preg_replace('/\D/', '', $this->phone);
        
        // Remove leading zeros and add country prefix if not present
        $phone = ltrim($phone, '0');
        if (!str_starts_with($phone, $countryPrefix)) {
            $phone = $countryPrefix . $phone;
        }

        return "https://wa.me/{$phone}";
    }
}
