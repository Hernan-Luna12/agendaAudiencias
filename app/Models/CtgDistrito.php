<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CtgDistrito
 * 
 * @property int $idDistrito
 * @property string $nombreDistrito
 * @property bool $activo
 * @property Carbon|null $updated_at
 * @property Carbon|null $created_at
 * 
 * @property Collection|CtgJuzgado[] $ctg_juzgados
 * @property Collection|Proceso[] $procesos
 *
 * @package App\Models
 */
class CtgDistrito extends Model
{
	protected $table = 'CtgDistritos';
	protected $primaryKey = 'idDistrito';

	protected $casts = [
		'activo' => 'bool'
	];

	protected $fillable = [
		'nombreDistrito',
		'activo'
	];

	public function ctg_juzgados()
	{
		return $this->hasMany(CtgJuzgado::class, 'idDistrito');
	}

	public function procesos()
	{
		return $this->hasMany(Proceso::class, 'idDistrito');
	}
}
