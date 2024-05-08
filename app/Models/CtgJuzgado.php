<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CtgJuzgado
 * 
 * @property int $idJuzgado
 * @property string $nombreJuzgado
 * @property bool $activo
 * @property int $idDistrito
 * @property int $idMateria
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property CtgDistrito $ctg_distrito
 * @property CtgMateria $ctg_materia
 * @property Collection|JuzgadosEtapa[] $juzgados_etapas
 * @property Collection|Proceso[] $procesos
 * @property Collection|JuzgadosSala[] $juzgados_salas
 * @property Collection|Juece[] $jueces
 *
 * @package App\Models
 */
class CtgJuzgado extends Model
{
	protected $table = 'CtgJuzgados';
	protected $primaryKey = 'idJuzgado';

	protected $casts = [
		'activo' => 'bool',
		'idDistrito' => 'int',
		'idMateria' => 'int'
	];

	protected $fillable = [
		'nombreJuzgado',
		'activo',
		'idDistrito',
		'idMateria'
	];

	public function ctg_distrito()
	{
		return $this->belongsTo(CtgDistrito::class, 'idDistrito');
	}

	public function ctg_materia()
	{
		return $this->belongsTo(CtgMateria::class, 'idMateria');
	}

	public function juzgados_etapas()
	{
		return $this->hasMany(JuzgadosEtapa::class, 'idJuzgado');
	}

	public function procesos()
	{
		return $this->hasMany(Proceso::class, 'idJuzgado');
	}

	public function juzgados_salas()
	{
		return $this->hasMany(JuzgadosSala::class, 'idJuzgado');
	}

	public function jueces()
	{
		return $this->hasMany(Juece::class, 'idJuzgado');
	}
}
