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

Carbon::setToStringFormat('d.m.Y - H:i:s');

/**
 * @method static paginate(mixed $env)
 * @method static find(int $id)
 * @method static findOrFail(int $id)
 * @method static create(array $array)
 * @method static where(mixed $var1, mixed $var2)
 * @property int id
 * @property int country_id
 * @property string email
 * @property string login
 * @property string full_name
 * @property string password
 * @property Carbon birth_date
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, HasPermissions;

    /**
     * The name of the field that will be used to log in to the system.
     *
     * @var string
     */
    const AUTH_FIELD = 'login';

    /**
     * Minimum password length.
     *
     * @var int
     */
    const PASSWORD_MIN_LENGHT = 6;

    /**
     * Check password has not been compromised in a public password data breach leak.
     * This constant determines how many times the password password must appear in the same data leak to be considered compromised.
     *
     * @note If the value is set to less than or equal to 0, the check is not performed.
     *
     * @var int
     */
    const PASSWORD_UNCOMPROMISED_COUNT = 0;

    const GENDER_NONE = 'gender_none';
    const GENDER_MALE = 'gender_male';
    const GENDER_FEMALE = 'gender_female';
    const GENDER_X = 'gender_x';

    /**
     * @var array
     */
    const GENDERS = [
        User::GENDER_NONE,
        User::GENDER_MALE,
        User::GENDER_FEMALE,
        User::GENDER_X
    ];

    /**
     * The default role that is assigned to the user during registration.
     *
     * @var string
     */
    const DEFAULT_USER_ROLE = Role::ROLE_USER;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login',
        'email',
        'password',
        'country_id',
        'full_name',
        'gender',
        'birth_date',
        'biography'
    ];

    /**
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'birth_date'];

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
        'full_name' => 'string',
        'email_verified_at' => 'datetime',
        'role_name' => 'string',
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
            ($country ? "countries.list.$country->short_code" : 'Не указано') :
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
     * Gets the formatted date of birth of a specific user.
     *
     * @return string
     */
    public function getBirthDateFmtAttribute(): string
    {
        return !empty($this->birth_date) ? $this->birth_date->format('d.m.Y') : 'Не указано';
    }

    /**
     * Gets the date of birth of a specific user converted to string.
     *
     * @return string|null
     */
    public function getBirthDateStrAttribute(): ?string
    {
        return empty($this->birth_date) ? null : $this->birth_date->toDateString();
    }

//    /**
//     * Gets full name of a specific user.
//     *
//     * @return string
//     */
//    public function getFullNameAttribute(): string
//    {
//        return $this->full_name ?? 'Не указано';
//    }
}
