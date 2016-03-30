<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {

	/**
	 * a list of admin emails
	 * @var array
	 */
	protected $admins = [
		'melinda.lesueur@jordandistrict.org',
		'john.lesueur@gmail.com',
		'jlesueur@bamboohr.com',
		'melinda.lesueur@gmail.com',
	];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'password', 'group_id',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	/**
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function group() {
		return $this->belongsTo(Group::class);
	}

	public function isAdmin() {
		return in_array($this->email, $this->admins);
	}

}
