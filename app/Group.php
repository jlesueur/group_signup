<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model {


	protected $fillable = [
		'name', 'chaperone_email'
	];
	/**
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function user() {
		return $this->hasMany(User::class);
	}

}
