<?php

namespace App\Models;

//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Hash;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Traits\HasPermissions;
use Illuminate\Notifications\Notifiable;

/**
 * @method static paginate(mixed $env)
 * @method static find(int $id)
 * @method static findOrFail(int $id)
 * @method static create(array $array)
 * @property int id
 * @property string email
 * @property string name
 * @property string password
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, HasPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'country_id',
        'biography',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @var array
     */
    protected $appends = [
        'role_name',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'role_name' => 'string',
    ];

    /**
     * Sets a hash instead of a valid password.
     *
     * @param $password
     */
    public function setPasswordAttribute($password)
    {
        if (!empty($password)) {
            $this->attributes['password'] = Hash::make($password);
        }
    }

    /**
     * Gets role name of a specific user.
     *
     * @return string
     */
    public function getRoleNameAttribute(): string
    {
        return $this->getRoleNames()->first();
    }
}
