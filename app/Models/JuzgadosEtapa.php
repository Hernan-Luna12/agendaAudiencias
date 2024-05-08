<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class JuzgadosEtapa
 * 
 * @property int $idJuzgadoEtapa
 * @property int $idJuzgado
 * @property int $idEtapa
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property CtgJuzgado $ctg_juzgado
 * @property CtgEtapa $ctg_etapa
 *
 * @package App\Models
 */
class JuzgadosEtapa extends Model
{
	protected $table = 'JuzgadosEtapas';
	protected $primaryKey = 'idJuzgadoEtapa';

	protected $casts = [
		'idJuzgado' => 'int',
		'idEtapa' => 'int'
	];

	protected $fillable = [
		'idJuzgado',
		'idEtapa'
	];

	public function ctg_juzgado()
	{
		return $this->belongsTo(CtgJuzgado::class, 'idJuzgado');
	}

	public function ctg_etapa()
	{
		return $this->belongsTo(CtgEtapa::class, 'idEtapa');
	}
}
