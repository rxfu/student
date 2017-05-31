<?php

namespace App\Models;

use App\Models\Teacher;
use Illuminate\Database\Eloquent\Model;

/**
 * 毕业论文表
 *
 * @author FuRongxin
 * @date 2017-05-29
 * @version 2.2
 */
class Thesis extends Model {

	protected $table = 'sj_bylw';

	protected $primaryKey = 'xh';

	public $incrementing = false;

	public $timestamps = false;

	/**
	 * 指导教师
	 * @author FuRongxin
	 * @date    2017-05-29
	 * @version 2.2
	 * @return  object 所属对象
	 */
	public function instructor() {
		return $this->belongsTo('App\Models\Teacher', 'zdjs', 'jsgh');
	}

	/**
	 * 评阅教师
	 * @author FuRongxin
	 * @date    2017-05-29
	 * @version 2.2
	 * @return  object 所属对象
	 */
	public function reviewer() {
		return $this->belongsTo('App\Models\Teacher', 'pyjs', 'jsgh');
	}

	/**
	 * 学院
	 * @author FuRongxin
	 * @date    2017-05-29
	 * @version 2.2
	 * @return  object     所属对象
	 */
	public function college() {
		return $this->belongsTo('App\Models\Department', 'xy', 'dw');
	}

	/**
	 * 主修专业
	 * @author FuRongxin
	 * @date    2017-05-29
	 * @version 2.2
	 * @return  object     所属对象
	 */
	public function major() {
		return $this->belongsTo('App\Models\Major', 'zy', 'zy');
	}

	/**
	 * 扩展查询，用于对应届数毕业论文信息
	 * @author FuRongxin
	 * @date    2017-05-30
	 * @version 2.2
	 * @param   \Illuminate\Database\Eloquent\Builder $query 查询对象
	 * @param   string $js 届数
	 * @return  \Illuminate\Database\Eloquent\Builder 查询对象
	 */
	public function scopeOfJs($query, $js) {
		if (!empty($js)) {
			return $query->whereJs($js);
		}
	}

	/**
	 * 扩展查询，用于对应学院毕业论文信息
	 * @author FuRongxin
	 * @date    2017-05-30
	 * @version 2.2
	 * @param   \Illuminate\Database\Eloquent\Builder $query 查询对象
	 * @param   string $xy 学院
	 * @return  \Illuminate\Database\Eloquent\Builder 查询对象
	 */
	public function scopeOfXy($query, $xy) {
		if ('all' !== $xy) {
			return $query->whereXy($xy);
		}
	}

	/**
	 * 扩展查询，用于对应专业毕业论文信息
	 * @author FuRongxin
	 * @date    2017-05-30
	 * @version 2.2
	 * @param   \Illuminate\Database\Eloquent\Builder $query 查询对象
	 * @param   string $zy 专业
	 * @return  \Illuminate\Database\Eloquent\Builder 查询对象
	 */
	public function scopeOfZy($query, $zy) {
		if ('all' !== $zy) {
			return $query->whereZy($zy);
		}
	}

	/**
	 * 扩展查询，用于对应课题来源毕业论文信息
	 * @author FuRongxin
	 * @date    2017-05-30
	 * @version 2.2
	 * @param   \Illuminate\Database\Eloquent\Builder $query 查询对象
	 * @param   string $ly 课题来源
	 * @return  \Illuminate\Database\Eloquent\Builder 查询对象
	 */
	public function scopeOfLy($query, $ly) {
		if ('all' !== $ly) {
			return $query->whereLy($ly);
		}
	}

	/**
	 * 扩展查询，用于对应是否科研项目毕业论文信息
	 * @author FuRongxin
	 * @date    2017-05-30
	 * @version 2.2
	 * @param   \Illuminate\Database\Eloquent\Builder $query 查询对象
	 * @param   string $ky 是否科研项目
	 * @return  \Illuminate\Database\Eloquent\Builder 查询对象
	 */
	public function scopeOfKy($query, $ky) {
		if ('all' !== $ky) {
			return $query->whereKy($ky);
		}
	}

	/**
	 * 扩展查询，用于对应是否优秀毕业论文信息
	 * @author FuRongxin
	 * @date    2017-05-30
	 * @version 2.2
	 * @param   \Illuminate\Database\Eloquent\Builder $query 查询对象
	 * @param   string $yx 是否优秀论文
	 * @return  \Illuminate\Database\Eloquent\Builder 查询对象
	 */
	public function scopeOfYx($query, $yx) {
		if ('all' !== $yx) {
			return $query->whereYx($yx);
		}
	}

	/**
	 * 扩展查询，用于对应学号毕业论文信息
	 * @author FuRongxin
	 * @date    2017-05-30
	 * @version 2.2
	 * @param   \Illuminate\Database\Eloquent\Builder $query 查询对象
	 * @param   string $xh 学号
	 * @return  \Illuminate\Database\Eloquent\Builder 查询对象
	 */
	public function scopeOfXh($query, $xh) {
		if (!empty($xh)) {
			return $query->whereXh($xh);
		}
	}

	/**
	 * 扩展查询，用于对应姓名毕业论文信息
	 * @author FuRongxin
	 * @date    2017-05-30
	 * @version 2.2
	 * @param   \Illuminate\Database\Eloquent\Builder $query 查询对象
	 * @param   string $xm 姓名
	 * @return  \Illuminate\Database\Eloquent\Builder 查询对象
	 */
	public function scopeOfXm($query, $xm) {
		if (!empty($xm)) {
			return $query->whereXm($xm);
		}
	}

	/**
	 * 扩展查询，用于对应指导教师毕业论文信息
	 * @author FuRongxin
	 * @date    2017-05-30
	 * @version 2.2
	 * @param   \Illuminate\Database\Eloquent\Builder $query 查询对象
	 * @param   string $zdjs 指导教师
	 * @return  \Illuminate\Database\Eloquent\Builder 查询对象
	 */
	public function scopeOfZdjs($query, $zdjs) {
		if (!empty($zdjs)) {

			$teachers = Teacher::where('xm', 'like', '%' . $zdjs . '%')
				->lists('jsgh')
				->all();

			return $query->whereIn('zdjs', $teachers);
		}
	}
}
