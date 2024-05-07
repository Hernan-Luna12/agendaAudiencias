<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Persona
 * 
 * @property int $id
 * @property string|null $nombre
 * @property string|null $primerapellido
 * @property string|null $segundoapellido
 * @property int|null $tipo_persona_id
 * @property int|null $rol_persona_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Persona extends Model
{
	protected $table = 'personas';

	protected $casts = [
		'tipo_persona_id' => 'int',
		'rol_persona_id' => 'int'
	];

	protected $fillable = [
		'nombre',
		'primerapellido',
		'segundoapellido',
		'tipo_persona_id',
		'rol_persona_id'
	];
}
