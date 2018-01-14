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
		return $this->belongsTo('App\Models\Dcxmlb', 'xmlb_dm', 'dm');
	}

	/**
	 * 一级学科
	 * @author FuRongxin
	 * @date    2017-11-22
	 * @version 2.3
	 * @return  object 所属对象
	 */
	public function subject() {
		return $this->belongsTo('App\Models\Dcyjxk', 'yjxk_dm', 'dm');
	}

	/**
	 * 项目成员
	 * @author FuRongxin
	 * @date    2017-12-04
	 * @version 2.3
	 * @return  object 所属对象
	 */
	public function members() {
		return $this->hasMany('App\Models\Dcxmcy', 'xm_id', 'id')->orderBy('pm');
	}

	/**
	 * 指导教师
	 * @author FuRongxin
	 * @date    2017-12-04
	 * @version 2.3
	 * @return  object 所属对象
	 */
	public function tutors() {
		return $this->hasMany('App\Models\Dczdjs', 'xm_id', 'id')->orderBy('pm');
	}

	/**
	 * 项目申报书
	 * @author FuRongxin
	 * @date    2018-01-14
	 * @version 2.3
	 * @return  object 所属对象
	 */
	public function application() {
		return $this->hasOne('App\Models\Dcxmsq', 'xm_id', 'id');
	}
}
