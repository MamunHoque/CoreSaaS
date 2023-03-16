<?php

namespace App\Helper\Traits;

use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use App\Models\Role;
use App\Models\User;
use App\Models\Permission;

/**
 * User Role Permissions management trait
 */
trait UserRolePermission
{
	/**
	 * @return bool.
	 */
	public function isAdmin()
	{
		return $this->hasRole('admin');
	}

	/**
	 * @return object default User Role.
	 */
	public function role()
	{
		return $this->belongsTo(Role::class);
	}

	/**
	 * @return object alternative User Roles.
	 */
	public function roles()
	{
		return $this->belongsToMany(Role::class, 'user_role')->withTimestamps();
	}

	/**
	 * @return object all User Roles, merging the default and alternative roles.
	 */
	public function roles_all()
	{
		$this->loadRolesRelations();

		return collect([$this->role])->merge($this->roles);
	}

	/**
	 * Check if User has a Role(s) associated.
	 *
	 * @param string|array $name The role(s) to check.
	 *
	 * @return bool
	 */
	public function hasRole($name)
	{
		$roles = $this->roles_all()->pluck('name')->toArray();

		foreach ((is_array($name) ? $name : [$name]) as $role) {
			if (in_array($role, $roles)) {
				return true;
			}
		}

		return false;
	}

	/**
	 * Set default User Role.
	 *
	 * @param string $name The role name to associate.
	 * 
	 * @return object
	 */
	public function setRole($name)
	{
		$role = Role::where('name', '=', $name)->first();

		if ($role) {
			$this->role()->associate($role);
			$this->save();
		}

		return $this;
	}

	/**
	 * Check the given permission token is associated with the authenticated user or note
	 * 
	 * @param string $name	Permission name
	 * 
	 * @return bool
	 */
	public function hasPermission($name)
	{
		$this->loadPermissionsRelations();

		$_permissions = $this->roles_all()
							->pluck('permissions')->flatten()
							->pluck('name')->unique()->toArray();

		$name = \is_array($name) ? $name : [$name];
		
		if (! array_intersect($_permissions, $name)) {
			return false;
		}
		
		return true;
	}

	/**
	 * Check Has permission or not
	 * 
	 * @param string $name Permission name
	 * 
	 * @return bool
	 */
	public function hasPermissionOrFail($name)
	{
		if (! $this->hasPermission($name)) {
			throw new UnauthorizedHttpException('');
		}

		return true;
	}

	/**
	 * Check Has permission or Abort with 403 Message
	 * 
	 * @param string 	$name				Permission name
	 * @param int 		$statusCode Abortion status code
	 * 
	 * @return bool
	 */
	public function hasPermissionOrAbort($name, $statusCode = 403)
	{
		if (!$this->hasPermission($name)) {
			return abort($statusCode);
		}

		return true;
	}

	/**
	 * Load Related Roles
	 * 
	 * @return void
	 */
	private function loadRolesRelations()
	{
		if (! $this->relationLoaded('role')) {
			$this->load('role');
		}

		if (! $this->relationLoaded('roles')) {
			$this->load('roles');
		}
	}

	/**
	 * Load Associated roles permission
	 * 
	 * @return void
	 */
	private function loadPermissionsRelations()
	{
		$this->loadRolesRelations();

		if (! $this->role->relationLoaded('permissions')) {
			$this->role->load('permissions');
			$this->load('roles.permissions');
		}
	}
}
