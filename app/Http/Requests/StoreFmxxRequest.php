<?php

namespace App\Http\Requests;

use App\Rules\Idnumber;
use Illuminate\Foundation\Http\FormRequest;

class StoreFmxxRequest extends FormRequest {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		return [
			'fmxm1'   => 'required_with:fmzjhm1',
			'fmxm2'   => 'required_with:fmzjhm2',
			'fmzjhm1' => 'required_with:fmxm1',
			'fmzjhm2' => 'required_with:fmxm2',
			'fmzjlx1' => 'required_with:fmxm1,fmzjhm1',
			'fmzjlx2' => 'required_with:fmxm2,fmzjhm2',
		];
	}

	/**
	 * Get the error messages for the defined validation rules.
	 *
	 * @return array
	 */
	public function messages() {
		return [
			'fmxm1.required_with'   => '须填写父母或监护人1姓名',
			'fmxm2.required_with'   => '须填写父母或监护人2姓名',
			'fmzjhm1.required_with' => '须填写父母或监护人1身份证件号码',
			'fmzjhm2.required_with' => '须填写父母或监护人2身份证件号码',
			'fmzjlx1.required_with' => '须选择父母或监护人1身份证件类型',
			'fmzjlx2.required_with' => '须选择父母或监护人2身份证件类型',
		];
	}

	/**
	 * Configure the validator instance.
	 *
	 * @param  \Illuminate\Validation\Validator  $validator
	 * @return void
	 */
	public function withValidator($validator) {
		$validator->sometimes('fmzjhm1', [new Idnumber], function ($input) {
			return $input->fmzjlx1 == '1-居民身份证';
		});

		$validator->sometimes('fmzjhm2', [new Idnumber], function ($input) {
			return $input->fmzjlx2 == '1-居民身份证';
		});
	}
}
