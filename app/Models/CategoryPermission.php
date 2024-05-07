<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CategoryPermission
 * 
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property bool $activo
 *
 * @package App\Models
 */
class CategoryPermission extends Model
{
	protected $table = 'category_permissions';

	protected $casts = [
		'activo' => 'bool'
	];

	protected $fillable = [
		'name',
		'activo'
	];

	public function permissions()
	{
		return $this->hasMany(Permission::class, 'category_id', 'id');
	}
}
