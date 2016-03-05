<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model {

	/**
	 * Set the keys for a save update query.
	 * This is a fix for tables with composite keys
	 *
	 * @param  \Illuminate\Database\Eloquent\Builder  $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	protected function setKeysForSaveQuery(Builder $query) {
		if (is_array($this->secondaryKey)) {
			foreach ($this->secondaryKey as $pk) {
				$query->where($pk, '=', $this->original[$pk]);
			}
			return $query;
		} else {
			return parent::setKeysForSaveQuery($query);
		}
	}
}
