<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CtgMateria
 * 
 * @property int $idMateria
 * @property string $nombreMateria
 * @property bool $activo
 * @property int $idTipoPartes
 * @property int $idDocumento
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property CtgTipoParte $ctg_tipo_parte
 * @property CtgNombreDocumento $ctg_nombre_documento
 * @property Collection|CtgJuzgado[] $ctg_juzgados
 * @property Collection|MateriaEtapa[] $materia_etapas
 * @property Collection|DelitosPresMaterium[] $delitos_pres_materia
 * @property Collection|Proceso[] $procesos
 * @property Collection|Juece[] $jueces
 * @property Collection|CtgAudiencia[] $ctg_audiencias
 *
 * @package App\Models
 */
class CtgMateria extends Model
{
	protected $table = 'CtgMaterias';
	protected $primaryKey = 'idMateria';

	protected $casts = [
		'activo' => 'bool',
		'idTipoPartes' => 'int',
		'idDocumento' => 'int'
	];

	protected $fillable = [
		'nombreMateria',
		'activo',
		'idTipoPartes',
		'idDocumento'
	];

	public function ctg_tipo_parte()
	{
		return $this->belongsTo(CtgTipoParte::class, 'idTipoPartes');
	}

	public function ctg_nombre_documento()
	{
		return $this->belongsTo(CtgNombreDocumento::class, 'idDocumento');
	}

	public function ctg_juzgados()
	{
		return $this->hasMany(CtgJuzgado::class, 'idMateria');
	}

	public function materia_etapas()
	{
		return $this->hasMany(MateriaEtapa::class, 'idMateria');
	}

	public function delitos_pres_materia()
	{
		return $this->hasMany(DelitosPresMaterium::class, 'idMateria');
	}

	public function procesos()
	{
		return $this->hasMany(Proceso::class, 'idMateria');
	}

	public function jueces()
	{
		return $this->hasMany(Juece::class, 'idMateria');
	}

	public function ctg_audiencias()
	{
		return $this->hasMany(CtgAudiencia::class, 'idMateria');
	}
}
