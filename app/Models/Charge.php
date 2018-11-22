<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Charge extends Model {

	protected $connection = 'sqlsrv';

	protected $table = 'VW_Mid_ChargeMid';

	protected $primaryKey = 'StudentCode';

	public $incrementing = false;

	public $timestamps = false;
}
