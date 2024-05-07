<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CtgDistrito
 * 
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property bool $activo
 * 
 * @property Collection|CtgCentrosTrabajo[] $ctg_centros_trabajos
 *
 * @package App\Models
 */
class CtgDistrito extends Model
{
	protected $table = 'ctg_distritos';

	protected $casts = [
		'activo' => 'bool'
	];

	protected $fillable = [
		'name',
		'activo'
	];

	public function ctg_centros_trabajos()
	{
		return $this->hasMany(CtgCentrosTrabajo::class, 'distrito_id');
	}
}
