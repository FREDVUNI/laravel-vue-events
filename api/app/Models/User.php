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

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    // protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */

    public static function FetchUsers()
    {
        return self::all();
    }
    public static function createUser(array $data)
    {
        return self::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
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
        return self::where('id', $id)->firstOrFail();
    }
    public static function editUser($id)
    {
        return self::where('id', $id)->firstOrFail();
    }
    public static function updateUser($id, array $data)
    {
        $user = self::where('id', $id)->firstOrFail();

        if (!$user) {
            return $user;
        }
        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ]);

        return $user;
    }
    public static function deleteUser($id)
    {
        $user = self::where('id', $id)->firstOrFail();
        $user->delete();
    }

    protected $hidden = [
        'password',
        'remem
        ber_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
