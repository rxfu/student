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
	 * 学号
	 * @author FuRongxin
	 * @date    2016-01-20
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function user() {
		return $this->belongsTo('App\Models\User', 'xh', 'xh');
	}

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

	/**
	 * 扩展查询，用于查找学生是否是全日制本科新生
	 * @author FuRongxin
	 * @date    2016-02-22
	 * @version 2.0
	 * @param   \Illuminate\Database\Eloquent\Builder $query 查询对象
	 * @param   object $user 用户对象
	 * @return  \Illuminate\Database\Eloquent\Builder 查询对象
	 */
	public function scopeIsFresh($query, $user) {
		return $query->whereXh($user->xh)
			->whereXjzt(config('constants.school.student'))
			->whereRaw('age(CURRENT_DATE, date_trunc(\'month\', rxrq)) < \'1 year\'')
			->where('xz', '<>', '2');
	}

	/**
	 * 处分信息
	 * @author FuRongxin
	 * @date    2017-10-27
	 * @version 2.2.4
	 * @return  object 所属对象
	 */
	public function cfxxs() {
		return $this->hasMany('App\Models\Cfxx', 'xh', 'xh');
	}

}
