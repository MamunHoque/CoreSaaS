<?php

namespace App\Helper\Traits;

/**
 * Permissions DataSet Traits
 */
trait Permissions
{
	/**
	 * Default permissions dataSet
	 * 
	 * @var array
	 */
	protected static $default = [
		'add' => 'Add',
		'browse' => 'Browse',
		'delete' => 'Delete',
		'edit' => 'Edit',
		'read' => 'Read'
	];
}
