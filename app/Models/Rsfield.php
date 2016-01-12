<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 专业类别
 *
 * @author FuRongxin
 * @date 2016-1-12
 * @version 2.0
 */
class Rsfield extends Model {

	protected $table = 'zd_zylb';

	protected $primaryKey = 'dm';

	public $incrementing = false;

	public $timestamps = false;

	public function profiles() {
		return $this->hasMany('App\Models\Profile', 'zylb', 'dm');
	}
}
