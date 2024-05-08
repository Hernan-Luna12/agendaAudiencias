<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class JuzgadosSala
 * 
 * @property int $idJuzgadoSala
 * @property int $idJuzgado
 * @property int $idSala
 * @property Carbon|null $create_at
 * @property Carbon|null $update_at
 * 
 * @property CtgJuzgado $ctg_juzgado
 * @property CtgSala $ctg_sala
 * @property Collection|Audiencia[] $audiencias
 *
 * @package App\Models
 */
class JuzgadosSala extends Model
{
	protected $table = 'JuzgadosSalas';
	protected $primaryKey = 'idJuzgadoSala';
	public $timestamps = false;

	protected $casts = [
		'idJuzgado' => 'int',
		'idSala' => 'int',
		'create_at' => 'datetime',
		'update_at' => 'datetime'
	];

	protected $fillable = [
		'idJuzgado',
		'idSala',
		'create_at',
		'update_at'
	];

	public function ctg_juzgado()
	{
		return $this->belongsTo(CtgJuzgado::class, 'idJuzgado');
	}

	public function ctg_sala()
	{
		return $this->belongsTo(CtgSala::class, 'idSala');
	}

	public function audiencias()
	{
		return $this->hasMany(Audiencia::class, 'idJuzgadoSala');
	}
}
