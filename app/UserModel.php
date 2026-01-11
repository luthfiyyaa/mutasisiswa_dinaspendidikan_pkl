<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserModel extends Model
{
  use Notifiable;

  protected $table = 'users';
  protected $primaryKey = 'id';
  protected $fillable = [
      'name', 'email', 'password',
  ];
  protected $hidden = [
      'password', 'remember_token',
  ];

  protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'group_id' => 'integer',
        'jenjang_id' => 'integer',
    ];

    /**
     * Get the main User model instance
     * This is for backward compatibility
     */
    public static function getUser(int $id): ?User
    {
        return User::find($id);
    }
}
