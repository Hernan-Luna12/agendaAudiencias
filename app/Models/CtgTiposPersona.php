<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CtgTiposPersona
 * 
 * @property int $id
 * @property string|null $name
 * @property bool $activo
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class CtgTiposPersona extends Model
{
	protected $table = 'ctg_tipos_persona';

	protected $casts = [
		'activo' => 'bool'
	];

	protected $fillable = [
		'name',
		'activo'
	];
}
