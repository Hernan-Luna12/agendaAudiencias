<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DelitoProceso
 * 
 * @property int $idDelitoproceso
 * @property int $idProceso
 * @property int $idDelito
 * @property Carbon|null $create_at
 * @property Carbon|null $update_at
 * 
 * @property Proceso $proceso
 * @property CtgDelitosprestacione $ctg_delitosprestacione
 *
 * @package App\Models
 */
class DelitoProceso extends Model
{
	protected $table = 'DelitoProceso';
	protected $primaryKey = 'idDelitoproceso';
	public $timestamps = false;

	protected $casts = [
		'idProceso' => 'int',
		'idDelito' => 'int',
		'create_at' => 'datetime',
		'update_at' => 'datetime'
	];

	protected $fillable = [
		'idProceso',
		'idDelito',
		'create_at',
		'update_at'
	];

	public function proceso()
	{
		return $this->belongsTo(Proceso::class, 'idProceso');
	}

	public function ctg_delitosprestacione()
	{
		return $this->belongsTo(CtgDelitosprestacione::class, 'idDelito');
	}
}
