<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Juece
 * 
 * @property int $idJuez
 * @property bool $activo
 * @property int $idJuzgado
 * @property int $idMateria
 * @property int $idTipoJuez
 * @property int $idJuecesmovimientos
 * @property int $idPersonas
 * @property Carbon|null $create_at
 * @property Carbon|null $update_at
 * 
 * @property CtgJuzgado $ctg_juzgado
 * @property CtgMateria $ctg_materia
 * @property CtgTipoJuez $ctg_tipo_juez
 * @property JuecesMovimiento $jueces_movimiento
 * @property Persona $persona
 * @property Collection|JuecesMovimiento[] $jueces_movimientos
 *
 * @package App\Models
 */
class Juece extends Model
{
	protected $table = 'Jueces';
	protected $primaryKey = 'idJuez';
	public $timestamps = false;

	protected $casts = [
		'activo' => 'bool',
		'idJuzgado' => 'int',
		'idMateria' => 'int',
		'idTipoJuez' => 'int',
		'idJuecesmovimientos' => 'int',
		'idPersonas' => 'int',
		'create_at' => 'datetime',
		'update_at' => 'datetime'
	];

	protected $fillable = [
		'activo',
		'idJuzgado',
		'idMateria',
		'idTipoJuez',
		'idJuecesmovimientos',
		'idPersonas',
		'create_at',
		'update_at'
	];

	public function ctg_juzgado()
	{
		return $this->belongsTo(CtgJuzgado::class, 'idJuzgado');
	}

	public function ctg_materia()
	{
		return $this->belongsTo(CtgMateria::class, 'idMateria');
	}

	public function ctg_tipo_juez()
	{
		return $this->belongsTo(CtgTipoJuez::class, 'idTipoJuez');
	}

	public function jueces_movimiento()
	{
		return $this->belongsTo(JuecesMovimiento::class, 'idJuecesmovimientos');
	}

	public function persona()
	{
		return $this->belongsTo(Persona::class, 'idPersonas');
	}

	public function jueces_movimientos()
	{
		return $this->hasMany(JuecesMovimiento::class, 'idJuez');
	}
}
