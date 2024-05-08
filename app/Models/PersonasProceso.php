<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PersonasProceso
 * 
 * @property int $idPersonaproceso
 * @property int $idPersona
 * @property int $idProceso
 * @property Carbon|null $create_at
 * @property Carbon|null $update_at
 * 
 * @property Persona $persona
 * @property Proceso $proceso
 *
 * @package App\Models
 */
class PersonasProceso extends Model
{
	protected $table = 'PersonasProcesos';
	protected $primaryKey = 'idPersonaproceso';
	public $timestamps = false;

	protected $casts = [
		'idPersona' => 'int',
		'idProceso' => 'int',
		'create_at' => 'datetime',
		'update_at' => 'datetime'
	];

	protected $fillable = [
		'idPersona',
		'idProceso',
		'create_at',
		'update_at'
	];

	public function persona()
	{
		return $this->belongsTo(Persona::class, 'idPersona');
	}

	public function proceso()
	{
		return $this->belongsTo(Proceso::class, 'idProceso');
	}
}
