<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CtgNombreDocumento
 * 
 * @property int $IdDocumento
 * @property string $Expediente
 * @property bool $activo
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|CtgMateria[] $ctg_materias
 *
 * @package App\Models
 */
class CtgNombreDocumento extends Model
{
	protected $table = 'CtgNombreDocumento';
	protected $primaryKey = 'IdDocumento';

	protected $casts = [
		'activo' => 'bool'
	];

	protected $fillable = [
		'Expediente',
		'activo'
	];

	public function ctg_materias()
	{
		return $this->hasMany(CtgMateria::class, 'idDocumento');
	}
}
