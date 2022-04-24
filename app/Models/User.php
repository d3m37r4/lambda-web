<?php

namespace App\Models;

//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Hash;
use Carbon\Carbon;
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
 * @method static where(mixed $var1, mixed $var2)
 * @property int id
 * @property int country_id
 * @property string email
 * @property string name
 * @property string full_name
 * @property string password
 * @property Carbon date_of_birth
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, HasPermissions;

    const GENDERS = [
        'male',
        'female',
        'gender x',
        'not specified'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'ip',
        'country_id',
        'full_name',
        'gender',
        'date_of_birth',
        'biography'
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
        'full_name',
        'role_name',
        'date_of_birth',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'full_name' => 'string',
        'email_verified_at' => 'datetime',
        'role_name' => 'string',
        'date_of_birth' => 'string',
    ];

    /**
     * Gets country of a specific user.
     *
     * @note Set 'useLocale' to 'true' if you want to get a localized translation string,
     *       or 'false' in order to get the standard name of the country in English.
     *
     * @param bool $useLocale
     * @return string
     */
    public function country(bool $useLocale = true): string
    {
        $country = Country::find($this->country_id);

        return $useLocale ?
            ($country ? "countries.$country->short_code" : 'Не указано') :
            ($country ? $country->default_name : 'Не указано');
    }

    /**
     * Checks whether user's country is specified.
     *
     * @return bool
     */
    public function isCountrySpecified(): bool {
        return (Country::find($this->country_id) ? true : false);
    }

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

    /**
     * Gets full name of a specific user.
     *
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return $this->full_name ?? 'Не указано';
    }
}
