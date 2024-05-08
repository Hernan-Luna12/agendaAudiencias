<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CtgEtapa
 * 
 * @property int $idEtapa
 * @property string $nombreEtapa
 * @property bool $activo
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|JuzgadosEtapa[] $juzgados_etapas
 * @property Collection|MateriaEtapa[] $materia_etapas
 * @property Collection|Proceso[] $procesos
 *
 * @package App\Models
 */
class CtgEtapa extends Model
{
	protected $table = 'CtgEtapas';
	protected $primaryKey = 'idEtapa';

	protected $casts = [
		'activo' => 'bool'
	];

	protected $fillable = [
		'nombreEtapa',
		'activo'
	];

	public function juzgados_etapas()
	{
		return $this->hasMany(JuzgadosEtapa::class, 'idEtapa');
	}

	public function materia_etapas()
	{
		return $this->hasMany(MateriaEtapa::class, 'idEtapa');
	}

	public function procesos()
	{
		return $this->hasMany(Proceso::class, 'idEtapa');
	}
}
