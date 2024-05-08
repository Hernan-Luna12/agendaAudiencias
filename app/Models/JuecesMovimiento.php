<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class JuecesMovimiento
 * 
 * @property int $idJuecesmovimientos
 * @property int $idJuez
 * @property int $idAudiencia
 * @property Carbon|null $create_at
 * @property Carbon|null $update_at
 * 
 * @property Juece $juece
 * @property Audiencia $audiencia
 * @property Collection|Juece[] $jueces
 * @property Collection|Audiencia[] $audiencias
 *
 * @package App\Models
 */
class JuecesMovimiento extends Model
{
	protected $table = 'JuecesMovimientos';
	protected $primaryKey = 'idJuecesmovimientos';
	public $timestamps = false;

	protected $casts = [
		'idJuez' => 'int',
		'idAudiencia' => 'int',
		'create_at' => 'datetime',
		'update_at' => 'datetime'
	];

	protected $fillable = [
		'idJuez',
		'idAudiencia',
		'create_at',
		'update_at'
	];

	public function juece()
	{
		return $this->belongsTo(Juece::class, 'idJuez');
	}

	public function audiencia()
	{
		return $this->belongsTo(Audiencia::class, 'idAudiencia');
	}

	public function jueces()
	{
		return $this->hasMany(Juece::class, 'idJuecesmovimientos');
	}

	public function audiencias()
	{
		return $this->hasMany(Audiencia::class, 'idJuecesMovimientos');
	}
}
