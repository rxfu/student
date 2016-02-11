<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 新生信息
 *
 * @author FuRongxin
 * @date 2016-02-06
 * @version 2.0
 */
class Fresh extends Model {

	protected $table = 'xs_xsb';

	protected $primaryKey = 'xh';

	public $incrementing = false;

	public $timestamps = false;

	/**
	 * 可被批量赋值的属性
	 * @var array
	 */
	protected $fillable = ['jg', 'jzxm', 'jtdz', 'hcdz'];

	/**
	 * 不可被批量赋值的属性
	 * @var array
	 */
	protected $guarded = ['xh'];
}
