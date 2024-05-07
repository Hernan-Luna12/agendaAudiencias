<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CtgGenero
 * 
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property bool $activo
 *
 * @package App\Models
 */
class CtgGenero extends Model
{
	protected $table = 'ctg_generos';

	protected $casts = [
		'activo' => 'bool'
	];

	protected $fillable = [
		'name',
		'activo'
	];
}
