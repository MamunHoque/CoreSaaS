<?php

namespace App\Helper\Traits;

use Illuminate\Support\Str;

/**
 * Handle base directory by namespace
 */
trait DirectoryHandler
{
	/**
	 * Convert namespace into base directory
	 * 
	 * @return string
	 */
	private function baseDirectory()
	{
		return \strtolower(
			str_replace('\\-', '\\', 
				Str::kebab(
					str_replace(
						['App\\Http\\Controllers\\', 'Controller'],
						'',
						(\get_called_class())
					)
				)
			)
		);
	}

	/**
	 * Convert to view directory
	 * 
	 * @param string $dir Top direcotry
	 * 
	 * @return string
	 */
	private function viewDir($dir)
	{
		return trim(str_replace('\\', '.', $this->baseDirectory()) . ".{$dir}", '.');
	}

	/**
	 * Returned view
	 * 
	 * @param string 	$dir 		Top directory
	 * @param array		$merged	Data that to be merged with view
	 * 
	 * @return object
	 */
	protected function view($dir, $merged = [])
	{
		return view($this->viewDir($dir), $merged);
	}
}
