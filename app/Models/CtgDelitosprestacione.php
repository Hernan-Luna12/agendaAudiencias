<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CtgDelitosprestacione
 * 
 * @property int $idDelito
 * @property string $nombreDelito
 * @property bool $activo
 * @property Carbon|null $create_at
 * @property Carbon|null $update_at
 * 
 * @property Collection|DelitoProceso[] $delito_procesos
 * @property Collection|DelitosPresMaterium[] $delitos_pres_materia
 *
 * @package App\Models
 */
class CtgDelitosprestacione extends Model
{
	protected $table = 'CtgDelitosprestaciones';
	protected $primaryKey = 'idDelito';
	public $timestamps = false;

	protected $casts = [
		'activo' => 'bool',
		'create_at' => 'datetime',
		'update_at' => 'datetime'
	];

	protected $fillable = [
		'nombreDelito',
		'activo',
		'create_at',
		'update_at'
	];

	public function delito_procesos()
	{
		return $this->hasMany(DelitoProceso::class, 'idDelito');
	}

	public function delitos_pres_materia()
	{
		return $this->hasMany(DelitosPresMaterium::class, 'idDelitosPrestaciones');
	}
}
