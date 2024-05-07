<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CtgRolesPersona
 * 
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property bool $activo
 *
 * @package App\Models
 */
class CtgRolesPersona extends Model
{
	protected $table = 'ctg_roles_persona';

	protected $casts = [
		'activo' => 'bool'
	];

	protected $fillable = [
		'name',
		'activo'
	];
}
