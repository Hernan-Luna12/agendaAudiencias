<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Audiencia
 * 
 * @property int $idAudiencia
 * @property int $idJuez
 * @property Carbon $fechaProgramada
 * @property time without time zone $horaprogramada
 * @property string $auxSala
 * @property int $idJuecesMovimientos
 * @property int $idProceso
 * @property int $idTipoaudiencia
 * @property int $idEstadoaudiencia
 * @property int $idUsuario
 * @property int $idJuzgadoSala
 * @property Carbon|null $create_at
 * @property Carbon|null $update_at
 * 
 * @property JuecesMovimiento $jueces_movimiento
 * @property Proceso $proceso
 * @property CtgAudiencia $ctg_audiencia
 * @property CtgEstadoAudiencium $ctg_estado_audiencium
 * @property JuzgadosSala $juzgados_sala
 * @property Collection|JuecesMovimiento[] $jueces_movimientos
 * @property DatosCompleAudiencium $datos_comple_audiencium
 *
 * @package App\Models
 */
class Audiencia extends Model
{
	protected $table = 'Audiencias';
	protected $primaryKey = 'idAudiencia';
	public $timestamps = false;

	protected $casts = [
		'idJuez' => 'int',
		'fechaProgramada' => 'datetime',
		'horaprogramada' => 'time without time zone',
		'idJuecesMovimientos' => 'int',
		'idProceso' => 'int',
		'idTipoaudiencia' => 'int',
		'idEstadoaudiencia' => 'int',
		'idUsuario' => 'int',
		'idJuzgadoSala' => 'int',
		'create_at' => 'datetime',
		'update_at' => 'datetime'
	];

	protected $fillable = [
		'idJuez',
		'fechaProgramada',
		'horaprogramada',
		'auxSala',
		'idJuecesMovimientos',
		'idProceso',
		'idTipoaudiencia',
		'idEstadoaudiencia',
		'idUsuario',
		'idJuzgadoSala',
		'create_at',
		'update_at'
	];

	public function jueces_movimiento()
	{
		return $this->belongsTo(JuecesMovimiento::class, 'idJuecesMovimientos');
	}

	public function proceso()
	{
		return $this->belongsTo(Proceso::class, 'idProceso');
	}

	public function ctg_audiencia()
	{
		return $this->belongsTo(CtgAudiencia::class, 'idTipoaudiencia');
	}

	public function ctg_estado_audiencium()
	{
		return $this->belongsTo(CtgEstadoAudiencium::class, 'idEstadoaudiencia');
	}

	public function juzgados_sala()
	{
		return $this->belongsTo(JuzgadosSala::class, 'idJuzgadoSala');
	}

	public function jueces_movimientos()
	{
		return $this->hasMany(JuecesMovimiento::class, 'idAudiencia');
	}

	public function datos_comple_audiencium()
	{
		return $this->hasOne(DatosCompleAudiencium::class, 'idDatoCompleAudiencia');
	}
}
