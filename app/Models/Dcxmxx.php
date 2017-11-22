<?php

namespace App\Models;

use App\Models\DcxmModel;

/**
 * 大创项目信息
 *
 * @author FuRongxin
 * @date 2017-11-22
 * @version 2.3
 */
class Dcxmxx extends DcxmModel {

	protected $table = 'dc_xmxx';

	protected $primaryKey = 'id';

	public $timestamps = false;

	protected $casts = [
		'sfsh' => 'boolean',
		'sftg' => 'boolean',
	];

	/**
	 * 项目类别
	 * @author FuRongxin
	 * @date    2017-11-22
	 * @version 2.3
	 * @return  object 所属对象
	 */
	public function category() {
		return $this->belongsTo('App\Models\Xmlb', 'xmlb_dm', 'dm');
	}
}
