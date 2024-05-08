<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MateriaEtapa
 * 
 * @property int $idMateriaEtapa
 * @property int $idMateria
 * @property int $idEtapa
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property CtgMateria $ctg_materia
 * @property CtgEtapa $ctg_etapa
 *
 * @package App\Models
 */
class MateriaEtapa extends Model
{
	protected $table = 'MateriaEtapa';
	protected $primaryKey = 'idMateriaEtapa';

	protected $casts = [
		'idMateria' => 'int',
		'idEtapa' => 'int'
	];

	protected $fillable = [
		'idMateria',
		'idEtapa'
	];

	public function ctg_materia()
	{
		return $this->belongsTo(CtgMateria::class, 'idMateria');
	}

	public function ctg_etapa()
	{
		return $this->belongsTo(CtgEtapa::class, 'idEtapa');
	}
}
