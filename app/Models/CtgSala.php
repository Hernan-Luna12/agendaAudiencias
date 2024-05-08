<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CtgSala
 * 
 * @property int $idSala
 * @property string $nombreSala
 * @property bool $activo
 * @property Carbon|null $create_at
 * @property Carbon|null $update_at
 * 
 * @property Collection|JuzgadosSala[] $juzgados_salas
 *
 * @package App\Models
 */
class CtgSala extends Model
{
	protected $table = 'CtgSalas';
	protected $primaryKey = 'idSala';
	public $timestamps = false;

	protected $casts = [
		'activo' => 'bool',
		'create_at' => 'datetime',
		'update_at' => 'datetime'
	];

	protected $fillable = [
		'nombreSala',
		'activo',
		'create_at',
		'update_at'
	];

	public function juzgados_salas()
	{
		return $this->hasMany(JuzgadosSala::class, 'idSala');
	}
}
