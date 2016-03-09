<?php

namespace App\Models;

use App\Models\BaseModel as Model;

/**
 * 选课申请表
 *
 * @author FuRongxin
 * @date 2016-02-23
 * @version 2.0
 */
class Application extends Model {

	protected $table = 'xk_xksq';

	protected $primaryKey = 'xh';

	public $incrementing = false;

	public $timestamps = false;

	// 修复删除操作
	protected $secondaryKey = ['xh', 'nd', 'xq', 'kcxh'];

	public static function boot() {
		parent::boot();

		static::created(function ($course) {
			$log = new Slog;

			$log->ip   = request()->ip();
			$log->kcxh = $course->kcxh;
			$log->czlx = 'apply';

			$log->save();
		});

		static::deleted(function ($course) {
			$log = new Slog;

			$log->ip   = request()->ip();
			$log->kcxh = $course->kcxh;
			$log->czlx = 'revoke';

			$log->save();
		});
	}

	/**
	 * 学期
	 * @author FuRongxin
	 * @date    2016-02-23
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function term() {
		return $this->belongsTo('App\Models\Term', 'xq', 'dm');
	}

	/**
	 * 原学期
	 * @author FuRongxin
	 * @date    2016-02-23
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function oterm() {
		return $this->belongsTo('App\Models\Term', 'yxq', 'dm');
	}

}
