<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CtgAudiencia
 * 
 * @property int $idTipoaudiencia
 * @property string $nombreAudiencia
 * @property bool $activo
 * @property int $idMateria
 * @property int $idAudiencia
 * @property Carbon|null $create_at
 * @property Carbon|null $update_at
 * 
 * @property CtgMateria $ctg_materia
 * @property Collection|Audiencia[] $audiencias
 *
 * @package App\Models
 */
class CtgAudiencia extends Model
{
	protected $table = 'CtgAudiencias';
	protected $primaryKey = 'idTipoaudiencia';
	public $timestamps = false;

	protected $casts = [
		'activo' => 'bool',
		'idMateria' => 'int',
		'idAudiencia' => 'int',
		'create_at' => 'datetime',
		'update_at' => 'datetime'
	];

	protected $fillable = [
		'nombreAudiencia',
		'activo',
		'idMateria',
		'idAudiencia',
		'create_at',
		'update_at'
	];

	public function ctg_materia()
	{
		return $this->belongsTo(CtgMateria::class, 'idMateria');
	}

	public function audiencias()
	{
		return $this->hasMany(Audiencia::class, 'idTipoaudiencia');
	}
}
