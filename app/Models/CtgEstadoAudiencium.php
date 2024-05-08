<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CtgEstadoAudiencium
 * 
 * @property int $idEstadoaudiencia
 * @property string $nombreEstadoaudiencia
 * @property bool $activo
 * @property Carbon|null $create_at
 * @property Carbon|null $update_at
 * 
 * @property Collection|Audiencia[] $audiencias
 *
 * @package App\Models
 */
class CtgEstadoAudiencium extends Model
{
	protected $table = 'CtgEstadoAudiencia';
	protected $primaryKey = 'idEstadoaudiencia';
	public $timestamps = false;

	protected $casts = [
		'activo' => 'bool',
		'create_at' => 'datetime',
		'update_at' => 'datetime'
	];

	protected $fillable = [
		'nombreEstadoaudiencia',
		'activo',
		'create_at',
		'update_at'
	];

	public function audiencias()
	{
		return $this->hasMany(Audiencia::class, 'idEstadoaudiencia');
	}
}
