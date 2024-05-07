<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CtgCentrosTrabajo
 * 
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property bool $activo
 * @property int $distrito_id
 * 
 * @property CtgDistrito $ctg_distrito
 * @property Collection|CtgArea[] $ctg_areas
 *
 * @package App\Models
 */
class CtgCentrosTrabajo extends Model
{
	protected $table = 'ctg_centros_trabajo';

	protected $casts = [
		'activo' => 'bool',
		'distrito_id' => 'int'
	];

	protected $fillable = [
		'name',
		'activo',
		'distrito_id'
	];

	public function ctg_distrito()
	{
		return $this->belongsTo(CtgDistrito::class, 'distrito_id');
	}
}
