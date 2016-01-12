<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 生源地
 *
 * @author FuRongxin
 * @date 2016-1-12
 * @version 2.0
 */
class Province extends Model {

	protected $table = 'zd_syszd';

	protected $primaryKey = 'dm';

	public $incrementing = false;

	public $timestamps = false;

	public function profiles() {
		return $this->hasMany('App\Models\Profile', 'syszd', 'dm');
	}
}
