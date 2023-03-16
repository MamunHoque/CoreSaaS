<?php

namespace App\Helper\Traits;

/**
 * Table class handler trait
 */
trait Tables
{
	/**
	 * Inactive tables
	 * 
	 * @var array
	 */
	protected static $void = [
		"failed_jobs",
		"migrations",
		"password_resets",
		"permission_role",
		"user_role"
	];
}
