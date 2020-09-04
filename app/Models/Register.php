<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 学生注册信息
 *
 * @author FuRongxin
 * @date 2020-9-4
 * @version 2.0
 */
class Register extends Model
{
	public $table = 'xs_zc';

	public $timestamps = false;

	public $primaryKey = 'xh';

    public function student() {
    	return belongsTo('App\Models\Profile', 'xh', 'xh');
    }
}
