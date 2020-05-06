<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 学分转换课程对照
 *
 * @author FuRongxin
 * @date 2018-11-29
 * @version 2.4
 */
class Xfzhkc extends Model {

	protected $table = 'xk_xfzhkc';

	protected $primaryKey = 'id';

	public $timestamps = false;

	public function application() {
		return $this->belongsTo('App\Models\Xfzhsq', 'appid', 'id');
	}

	/**
	 * 课程平台
	 * @author FuRongxin
	 * @date    2019-02-20
	 * @version 2.3
	 * @return  object 所属对象
	 */
	public function qplatform() {
		return $this->belongsTo('App\Models\Platform', 'qpt', 'dm');
	}

	/**
	 * 课程性质
	 * @author FuRongxin
	 * @date    2019-02-20
	 * @version 2.3
	 * @return  object 所属对象
	 */
	public function qproperty() {
		return $this->belongsTo('App\Models\Property', 'qxz', 'dm');
	}

	/**
	 * 课程平台
	 * @author FuRongxin
	 * @date    2019-02-20
	 * @version 2.3
	 * @return  object 所属对象
	 */
	public function platform() {
		return $this->belongsTo('App\Models\Platform', 'pt', 'dm');
	}

	/**
	 * 课程性质
	 * @author FuRongxin
	 * @date    2019-02-20
	 * @version 2.3
	 * @return  object 所属对象
	 */
	public function property() {
		return $this->belongsTo('App\Models\Property', 'xz', 'dm');
	}
}
