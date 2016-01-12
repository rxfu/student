<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 在校生个人资料
 *
 * @author FuRongxin
 * @date 2016-1-12
 * @version 2.0
 */
class Profile extends Model {

	protected $table = 'xs_zxs';

	protected $primaryKey = 'xh';

	public $incrementing = false;

	public $timestamps = false;

	/**
	 * 学院
	 * @author FuRongxin
	 * @date    2016-01-12
	 * @version 2.0
	 * @return  object     所属对象
	 */
	public function college() {
		return $this->belongsTo('App\Models\Department', 'xy', 'dw');
	}

	/**
	 * 主修专业
	 * @author FuRongxin
	 * @date    2016-01-12
	 * @version 2.0
	 * @return  object     所属对象
	 */
	public function major() {
		return $this->belongsTo('App\Models\Major', 'zy', 'zy');
	}

	/**
	 * 第二专业
	 * @author FuRongxin
	 * @date    2016-01-12
	 * @version 2.0
	 * @return  object     所属对象
	 */
	public function secondary() {
		return $this->belongsTo('App\Models\Major', 'zy2', 'zy');
	}

	/**
	 * 辅修专业
	 * @author FuRongxin
	 * @date    2016-01-12
	 * @version 2.0
	 * @return  object     所属对象
	 */
	public function minor() {
		return $this->belongsTo('App\Models\Major', 'fxzy', 'zy');
	}

	/**
	 * 性别
	 * @author FuRongxin
	 * @date    2016-01-12
	 * @version 2.0
	 * @return  object     所属对象
	 */
	public function gender() {
		return $this->belongsTo('App\Models\Gender', 'xbdm', 'dm');
	}

	/**
	 * 证件类型
	 * @author FuRongxin
	 * @date    2016-01-12
	 * @version 2.0
	 * @return  object     所属对象
	 */
	public function idtype() {
		return $this->belongsTo('App\Models\Idtype', 'zjlx', 'dm');
	}

	/**
	 * 国籍
	 * @author FuRongxin
	 * @date    2016-01-12
	 * @version 2.0
	 * @return  object     所属对象
	 */
	public function country() {
		return $this->belongsTo('App\Models\Country', 'gj', 'dm');
	}

	/**
	 * 民族
	 * @author FuRongxin
	 * @date    2016-01-12
	 * @version 2.0
	 * @return  object     所属对象
	 */
	public function nation() {
		return $this->belongsTo('App\Models\Nation', 'mzdm', 'dm');
	}

	/**
	 * 政治面貌
	 * @author FuRongxin
	 * @date    2016-01-12
	 * @version 2.0
	 * @return  object     所属对象
	 */
	public function party() {
		return $this->belongsTo('App\Models\Party', 'zzmm', 'dm');
	}

	/**
	 * 生源地
	 * @author FuRongxin
	 * @date    2016-01-12
	 * @version 2.0
	 * @return  object     所属对象
	 */
	public function province() {
		return $this->belongsTo('App\Models\Province', 'syszd', 'dm');
	}

	/**
	 * 系所
	 * @author FuRongxin
	 * @date    2016-01-12
	 * @version 2.0
	 * @return  object     所属对象
	 */
	public function school() {
		return $this->belongsTo('App\Models\School', 'xsh', 'dm');
	}

	/**
	 * 办学形式
	 * @author FuRongxin
	 * @date    2016-01-12
	 * @version 2.0
	 * @return  object     所属对象
	 */
	public function approach() {
		return $this->belongsTo('App\Models\Approach', 'bxxs', 'dm');
	}

	/**
	 * 办学类型
	 * @author FuRongxin
	 * @date    2016-01-12
	 * @version 2.0
	 * @return  object     所属对象
	 */
	public function sctype() {
		return $this->belongsTo('App\Models\Sctype', 'bxlx', 'dm');
	}

	/**
	 * 学习形式
	 * @author FuRongxin
	 * @date    2016-01-12
	 * @version 2.0
	 * @return  object     所属对象
	 */
	public function scform() {
		return $this->belongsTo('App\Models\Scform', 'xxxs', 'dm');
	}

	/**
	 * 招生季节
	 * @author FuRongxin
	 * @date    2016-01-12
	 * @version 2.0
	 * @return  object     所属对象
	 */
	public function season() {
		return $this->belongsTo('App\Models\Season', 'zsjj', 'dm');
	}

	/**
	 * 学籍状态
	 * @author FuRongxin
	 * @date    2016-01-12
	 * @version 2.0
	 * @return  object     所属对象
	 */
	public function status() {
		return $this->belongsTo('App\Models\Status', 'xjzt', 'dm');
	}

	/**
	 * 专业类别
	 * @author FuRongxin
	 * @date    2016-01-12
	 * @version 2.0
	 * @return  object     所属对象
	 */
	public function rsfield() {
		return $this->belongsTo('App\Models\Rsfield', 'zylb', 'dm');
	}

	/**
	 * 入学方式
	 * @author FuRongxin
	 * @date    2016-01-12
	 * @version 2.0
	 * @return  object     所属对象
	 */
	public function entrance() {
		return $this->belongsTo('App\Models\Entrance', 'rxfs', 'dm');
	}

}
