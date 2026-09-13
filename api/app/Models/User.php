<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const ROLE_ADMIN     = 'admin';
    const ROLE_ORGANIZER = 'organizer';
    const ROLE_ATTENDEE  = 'attendee';

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // ---- Role helpers ----
    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }
    public function isOrganizer(): bool
    {
        return $this->role === self::ROLE_ORGANIZER;
    }
    public function isAttendee(): bool
    {
        return $this->role === self::ROLE_ATTENDEE;
    }

    // ---- Relations ----
    public function organizedEvents()
    {
        return $this->hasMany(Event::class, 'organizer_id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    // ---- Static queries (kept from your original) ----
    public static function FetchUsers()
    {
        return self::latest()->get();
    }

    public static function createUser(array $data)
    {
        return self::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'role'     => $data['role'] ?? self::ROLE_ATTENDEE,
        ]);
    }

    public static function userLogin($data)
    {
        $user = self::where('email', $data['email'])->first();
        if (!$user || !Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => 'Wrong email password combination.',
            ]);
        }
        return $user;
    }

    public static function getUser($id)
    {
        return self::findOrFail($id);
    }
    public static function editUser($id)
    {
        return self::findOrFail($id);
    }

    public static function updateUser($id, array $data)
    {
        $user = self::findOrFail($id);
        $user->update([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'role'     => $data['role'] ?? $user->role,
            // only update password if provided
            ...(isset($data['password']) ? ['password' => Hash::make($data['password'])] : []),
        ]);
        return $user;
    }

    public static function deleteUser($id)
    {
        self::findOrFail($id)->delete();
    }
}
