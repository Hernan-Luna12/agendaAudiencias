<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DelitosPresMaterium
 * 
 * @property int $idDelitoPresMateria
 * @property int $idMateria
 * @property int $idDelitosPrestaciones
 * @property Carbon|null $create_at
 * @property Carbon|null $update_at
 * 
 * @property CtgMateria $ctg_materia
 * @property CtgDelitosprestacione $ctg_delitosprestacione
 *
 * @package App\Models
 */
class DelitosPresMaterium extends Model
{
	protected $table = 'DelitosPresMateria';
	protected $primaryKey = 'idDelitoPresMateria';
	public $timestamps = false;

	protected $casts = [
		'idMateria' => 'int',
		'idDelitosPrestaciones' => 'int',
		'create_at' => 'datetime',
		'update_at' => 'datetime'
	];

	protected $fillable = [
		'idMateria',
		'idDelitosPrestaciones',
		'create_at',
		'update_at'
	];

	public function ctg_materia()
	{
		return $this->belongsTo(CtgMateria::class, 'idMateria');
	}

	public function ctg_delitosprestacione()
	{
		return $this->belongsTo(CtgDelitosprestacione::class, 'idDelitosPrestaciones');
	}
}
