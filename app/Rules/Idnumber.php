<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Idnumber implements Rule {
	/**
	 * Create a new rule instance.
	 *
	 * @return void
	 */
	public function __construct() {
		//
	}

	/**
	 * Determine if the validation rule passes.
	 *
	 * @param  string  $attribute
	 * @param  mixed  $value
	 * @return bool
	 */
	public function passes($attribute, $value) {
		$id = strtoupper($value);

		if (preg_match('/^\d{6}(18|19|20)\d{2}(0[1-9]|1[012])(0[1-9]|[12]\d|3[01])\d{3}(\d|X)$/', $id)) {
			$year  = substr($id, 6, 4);
			$month = substr($id, 10, 2);
			$day   = substr($id, 12, 2);

			if (checkdate($month, $day, $year)) {
				$idbase           = substr($id, 0, 17);
				$factor           = [7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2];
				$verifyNumberList = ['1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2'];
				$checksum         = 0;
				for ($i = 0; $i < strlen($idbase); $i++) {
					$checksum += substr($idbase, $i, 1) * $factor[$i];
				}
				$mod = $checksum % 11;

				return $verifyNumberList[$mod] == substr($id, 17, 1);
			}
		}

		return false;
	}

	/**
	 * Get the validation error message.
	 *
	 * @return string
	 */
	public function message() {
		return ':attribute 身份证号格式不正确';
	}
}
