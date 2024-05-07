<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class User
 * 
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property int|null $current_team_id
 * @property string|null $profile_photo_path
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property Carbon|null $two_factor_confirmed_at
 * @property bool $activo
 * @property int|null $idcentrotrabajo
 *
 * @package App\Models
 */
class User extends Authenticatable
{
	use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
	use HasRoles;

	protected $table = 'users';

	public $incrementing = false;

	protected $casts = [
		'email_verified_at' => 'datetime',
		'current_team_id' => 'int',
		'two_factor_confirmed_at' => 'datetime',
		'activo' => 'bool',
		'centro_trabajo_id' => 'int'
	];

	protected $hidden = [
		'email_verified_at',
		'password',
		'remember_token',
		'current_team_id',
		'profile_photo_path',
		'two_factor_secret',
		'two_factor_recovery_codes',
		'two_factor_confirmed_at',
	];

	protected $fillable = [
		'name',
		'email',
		'email_verified_at',
		'password',
		'remember_token',
		'current_team_id',
		'profile_photo_path',
		'two_factor_secret',
		'two_factor_recovery_codes',
		'two_factor_confirmed_at',
		'activo',
		'centro_trabajo_id'
	];

	public function persona()
	{
		return $this->belongsTo(Persona::class, 'id');
	}

	public function ctg_centro_trabajo()
	{
		return $this->belongsTo(CtgCentrostrabajo::class, 'centro_trabajo_id');
	}

	public function role()
	{
		return $this->belongsTo(\Spatie\Permission\Models\Role::class, 'id');
	}
}
