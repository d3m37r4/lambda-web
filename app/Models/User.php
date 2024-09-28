<?php

namespace App\Models;

//use Illuminate\Contracts\Auth\MustVerifyEmail;
//use Carbon\Carbon;
//use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Casts\Attribute;
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
 * @property string login
 * @property string password
// * @property string full_name
// * @property Carbon birth_date
// * @property CarbonInterval age
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, HasPermissions;

    /**
     * Minimum password length.
     *
     * @var int
     */
    const PASSWORD_MIN_LENGHT = 6;

    /**
     * Check password has not been compromised in a public password data breach leak.
     * This constant determines how many times the password must appear in the same data leak to be considered compromised.
     *
     * @note If the value is set to less than or equal to 0, the check is not performed.
     *
     * @var int
     */
    const PASSWORD_UNCOMPROMISED_COUNT = 0;

    public const GENDER_NONE = 1;
    public const GENDER_MALE = 2;
    public const GENDER_FEMALE = 3;

    /**
     * @var array
     */
    public const GENDERS = [
        ['id' => self::GENDER_NONE, 'name' => 'Not specified'],
        ['id' => self::GENDER_MALE, 'name' => 'Male'],
        ['id' => self::GENDER_FEMALE, 'name' => 'Female'],
    ];

    /**
     * Constants defining the names of standard roles in the system.
     *
     * @note These constants are used in the system. There may be problems when changing and deleting.
     */
    const ROLE_OWNER = 'Owner';
    const ROLE_ADMIN = 'Admin';
    const ROLE_MODER = 'Moder';
    const ROLE_USER = 'User';

    /**
     * The default role that is assigned to the user during registration.
     *
     * @var string
     */
    const DEFAULT_USER_ROLE = User::ROLE_USER;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login',
        'email',
        'password',
        'role',
        'gender',
        'name',
        'country_id',
//        'birth_date',
//        'biography'
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
        'role',
//        'age'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:d.m.Y - H:i:s',
        'updated_at' => 'datetime:d.m.Y - H:i:s',
        'password' => 'hashed',
        'name' => 'string',
        'email_verified_at' => 'datetime'
    ];

    /**
     * Sets a hash instead of a valid password.
     *
     * @return Attribute
     */
    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => bcrypt($value)
        );
    }

    /**
     * Gets role name of a specific user.
     *
     * @return Attribute
     */
    protected function role(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->roles()->first()
        );
    }

    /**
     * Gets country of a specific user.
     *
     * @note Set 'useLocale' to 'true' if you want to get a localized translation string,
     *       or 'false' in order to get the standard name of the country in English.
     *
     * @param bool $useLocale
     * @return string
     */
//    public function country(bool $useLocale = true): string
//    {
//        $country = Country::find($this->country_id);
//
//        return $useLocale ?
//            ($country ? "countries.list.$country->short_code" : 'Не указано') :
//            ($country ? $country->default_name : 'Не указано');
//    }

    /**
     * Checks whether user's country is specified.
     *
     * @return bool
     */
//    public function isCountrySpecified(): bool
//    {
//        return (bool)Country::find($this->country_id);
//    }

    /**
     * Gets the formatted date of birth of a specific user.
     *
     * @return string
     */
//    public function getBirthDateFmtAttribute(): string
//    {
//        return isset($this->birth_date) ? $this->birth_date->format('d.m.Y') : 'Не указано';
//    }

    /**
     * Gets the date of birth of a specific user converted to string.
     *
     * @return string|null
     */
//    public function getBirthDateStrAttribute(): ?string
//    {
//        return empty($this->birth_date) ? null : $this->birth_date->toDateString();
//    }

    /**
     * Gets the user's age.
     *
     * @return string
     */
//    public function getAgeAttribute(): string
//    {
//        return isset($this->birth_date) ? CarbonInterval::years($this->birth_date->age) : 'Не указано';
//    }

    /**
     * Gets full name of a specific user.
     *
     * @return string
     */
//    public function getFullNameAttribute(): string
//    {
//        return $this->full_name ?? 'Не указано';
//    }
}
