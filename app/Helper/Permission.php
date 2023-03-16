<?php

namespace App\Helper;

use App\Helper\Traits\Permissions;
use App\Models\Permission as ModelsPermission;

/**
 * Permission Class Handles Permission DataSet and methods
 */
class Permission extends Helper
{
	use Permissions;

	/**
	 * Return requested Permission array from Permission Model
	 * 
	 * @param object $request  Requested data object
	 * 
	 * @return array
	 */
	public static function getRequestedPermissions($request)
	{
		return ModelsPermission::getRequestedPermissions($request);
	}
}
