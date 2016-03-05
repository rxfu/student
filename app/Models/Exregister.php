<?php

namespace App\Models;

use App\Models\BaseModel as Model;

/**
 * 考试报名信息
 *
 * @author FuRongxin
 * @date 2016-02-21
 * @version 2.0
 */
class Exregister extends Model {

	protected $table = 'ks_qtksbm';

	protected $primaryKey = 'xh';

	public $incrementing = false;

	public $timestamps = false;

	// 修复删除操作
	protected $secondaryKey = ['xh', 'kslx', 'kssj'];

	public static function boot() {
		parent::boot();

		static::created(function ($exam) {
			$log = new Slog;

			$log->ip   = request()->ip();
			$log->czlx = 'regist';

			$log->save();
		});

		static::deleted(function ($exam) {
			$log = new Slog;

			$log->ip   = request()->ip();
			$log->czlx = 'cancel';

			$log->save();
		});
	}

	/**
	 * 考试类型
	 * @author FuRongxin
	 * @date    2016-02-21
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function type() {
		return $this->belongsTo('App\Models\Extype', 'kslx', 'kslx');
	}

	/**
	 * 校区
	 * @author FuRongxin
	 * @date    2016-02-21
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function campus() {
		return $this->belongsTo('App\Models\Campus', 'xq', 'dm');
	}
}
