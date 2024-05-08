<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CtgTipoParte
 * 
 * @property int $idTipoParte
 * @property string $nombreTipoParte
 * @property bool $activo
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|CtgMateria[] $ctg_materias
 *
 * @package App\Models
 */
class CtgTipoParte extends Model
{
	protected $table = 'CtgTipoPartes';
	protected $primaryKey = 'idTipoParte';

	protected $casts = [
		'activo' => 'bool'
	];

	protected $fillable = [
		'nombreTipoParte',
		'activo'
	];

	public function ctg_materias()
	{
		return $this->hasMany(CtgMateria::class, 'idTipoPartes');
	}
}
