<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Charge extends Model {

	protected $connection = 'sqlsrv';

	protected $table = 'VT_FE_StuStandardB';

	protected $primaryKey = 'StudentNo';

	public $incrementing = false;

	public $timestamps = false;
}
