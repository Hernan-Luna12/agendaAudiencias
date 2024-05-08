<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DatosCompleAudiencium
 * 
 * @property int $idDatoCompleAudiencia
 * @property string $inicioGrabacion
 * @property string $terminoGrabacion
 * @property string $peso
 * @property string $respaldo
 * @property string $espacio_almacenamiento
 * @property string $temperatura_site
 * @property string $humedad_site
 * @property string $equipo_grabacion
 * @property string $videoconferencia
 * @property string $plataformavideoconferencia
 * @property string $respaldo_local
 * @property string $respaldo_servidor204
 * @property int $idAudiencia
 * @property Carbon|null $create_at
 * @property Carbon|null $update_at
 * 
 * @property Audiencia $audiencia
 *
 * @package App\Models
 */
class DatosCompleAudiencium extends Model
{
	protected $table = 'DatosCompleAudiencia';
	protected $primaryKey = 'idDatoCompleAudiencia';
	public $timestamps = false;

	protected $casts = [
		'idAudiencia' => 'int',
		'create_at' => 'datetime',
		'update_at' => 'datetime'
	];

	protected $fillable = [
		'inicioGrabacion',
		'terminoGrabacion',
		'peso',
		'respaldo',
		'espacio_almacenamiento',
		'temperatura_site',
		'humedad_site',
		'equipo_grabacion',
		'videoconferencia',
		'plataformavideoconferencia',
		'respaldo_local',
		'respaldo_servidor204',
		'idAudiencia',
		'create_at',
		'update_at'
	];

	public function audiencia()
	{
		return $this->belongsTo(Audiencia::class, 'idDatoCompleAudiencia');
	}
}
