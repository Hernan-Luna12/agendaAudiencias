<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CtgTipoJuez
 * 
 * @property int $idTipojuez
 * @property string $nombre
 * @property bool $activo
 * @property Carbon|null $create_at
 * @property Carbon|null $update_at
 * 
 * @property Collection|Juece[] $jueces
 *
 * @package App\Models
 */
class CtgTipoJuez extends Model
{
	protected $table = 'CtgTipoJuez';
	protected $primaryKey = 'idTipojuez';
	public $timestamps = false;

	protected $casts = [
		'activo' => 'bool',
		'create_at' => 'datetime',
		'update_at' => 'datetime'
	];

	protected $fillable = [
		'nombre',
		'activo',
		'create_at',
		'update_at'
	];

	public function jueces()
	{
		return $this->hasMany(Juece::class, 'idTipoJuez');
	}
}
