<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Persona
 * 
 * @property int $idPersona
 * @property string $nombre
 * @property string $primerApellido
 * @property string $segundoApellido
 * @property int $edad
 * @property Carbon|null $create_at
 * @property Carbon|null $update_at
 * 
 * @property Collection|Proceso[] $procesos
 * @property Collection|Juece[] $jueces
 *
 * @package App\Models
 */
class Persona extends Model
{
	protected $table = 'Personas';
	protected $primaryKey = 'idPersona';
	public $timestamps = false;

	protected $casts = [
		'edad' => 'int',
		'create_at' => 'datetime',
		'update_at' => 'datetime'
	];

	protected $fillable = [
		'nombre',
		'primerApellido',
		'segundoApellido',
		'edad',
		'create_at',
		'update_at'
	];

	public function procesos()
	{
		return $this->belongsToMany(Proceso::class, 'PersonasProcesos', 'idPersona', 'idProceso')
					->withPivot('idPersonaproceso', 'create_at', 'update_at');
	}

	public function jueces()
	{
		return $this->hasMany(Juece::class, 'idPersonas');
	}
}
