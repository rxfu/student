<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 毕业要求
 *
 * @author FuRongxin
 * @date 2016-01-21
 * @version 2.0
 */
class Requirement extends Model {

	protected $table = 'jx_byyq';

	protected $primaryKey = 'zy';

	public $incrementing = false;

	public $timestamps = false;

	/**
	 * 课程平台
	 * @author FuRongxin
	 * @date    2016-01-21
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function platform() {
		return $this->belongsTo('App\Models\Platform', 'pt', 'dm');
	}

	/**
	 * 课程性质
	 * @author FuRongxin
	 * @date    2016-01-21
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function property() {
		return $this->belongsTo('App\Models\Property', 'xz', 'dm');
	}

	/**
	 * 扩展查询，用于获取毕业要求学分
	 * @author FuRongxin
	 * @date    2016-01-23
	 * @version 2.0
	 * @param   \Illuminate\Database\Eloquent\Builder $query 查询对象
	 * @param   object $user 用户对象
	 * @return  \Illuminate\Database\Eloquent\Builder 查询对象
	 */
	public function scopeCredits($query, $user) {
		return $query->whereNj($user->profile->nj)
			->whereZy($user->profile->zy)
			->whereZsjj($user->profile->zsjj)
			->whereByfa($user->profile->byfa);
	}

}
