<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Proceso
 * 
 * @property int $idProceso
 * @property Carbon $fechaRadicion
 * @property string $folioProceso
 * @property bool $activo
 * @property int $idDistrito
 * @property int $idUser
 * @property int $idJuzgado
 * @property int $idMateria
 * @property int $idEtapa
 * @property Carbon|null $create_at
 * @property Carbon|null $update_at
 * 
 * @property CtgDistrito $ctg_distrito
 * @property CtgJuzgado $ctg_juzgado
 * @property CtgMateria $ctg_materia
 * @property CtgEtapa $ctg_etapa
 * @property Collection|DelitoProceso[] $delito_procesos
 * @property Collection|Persona[] $personas
 * @property Collection|Audiencia[] $audiencias
 *
 * @package App\Models
 */
class Proceso extends Model
{
	protected $table = 'Procesos';
	protected $primaryKey = 'idProceso';
	public $timestamps = false;

	protected $casts = [
		'fechaRadicion' => 'datetime',
		'activo' => 'bool',
		'idDistrito' => 'int',
		'idUser' => 'int',
		'idJuzgado' => 'int',
		'idMateria' => 'int',
		'idEtapa' => 'int',
		'create_at' => 'datetime',
		'update_at' => 'datetime'
	];

	protected $fillable = [
		'fechaRadicion',
		'folioProceso',
		'activo',
		'idDistrito',
		'idUser',
		'idJuzgado',
		'idMateria',
		'idEtapa',
		'create_at',
		'update_at'
	];

	public function ctg_distrito()
	{
		return $this->belongsTo(CtgDistrito::class, 'idDistrito');
	}

	public function ctg_juzgado()
	{
		return $this->belongsTo(CtgJuzgado::class, 'idJuzgado');
	}

	public function ctg_materia()
	{
		return $this->belongsTo(CtgMateria::class, 'idMateria');
	}

	public function ctg_etapa()
	{
		return $this->belongsTo(CtgEtapa::class, 'idEtapa');
	}

	public function delito_procesos()
	{
		return $this->hasMany(DelitoProceso::class, 'idProceso');
	}

	public function personas()
	{
		return $this->belongsToMany(Persona::class, 'PersonasProcesos', 'idProceso', 'idPersona')
					->withPivot('idPersonaproceso', 'create_at', 'update_at');
	}

	public function audiencias()
	{
		return $this->hasMany(Audiencia::class, 'idProceso');
	}
}
