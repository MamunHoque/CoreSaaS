<?php

namespace App\Helper;

use PHPUnit\Exception;
use App\Helper\Traits\CommonHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

/**
 * Common Class Handles CommonHelper DataSet and methods
 */
class Common extends Helper
{
	use CommonHandler;

	/**
	 * Find image
	 *
	 * @param string	$photo		Photo name
	 * @param string	$type		Image type      DEFAULT 'avatar'
	 * @return string
	 */
	public static function image($photo, $type = 'avatar')
	{
		$default = self::{$type}();

		try {
			if (Storage::disk('public')->exists($photo)) {
				return url("/") ."/storage/" .$photo;
			}

		} catch (\Throwable $th) {}

		return url("/") ."/images/" .$default;
	}

	/**
	 * Find old image
	 *
	 * @param \Illuminate\Http\Request 	$request	Request set containing file name
	 * @param string	                $filename	Request file name
	 * @param string 	                $existing	Existing image
	 * @param string	                $type		Image type
	 */
	public static function oldImage(Request $request, $filename, $existing, $type = 'avatar')
	{
		return ($request->file($filename) &&
					$request->file($filename)->getClientOriginalName() != self::{$type}())
				? $existing : "";
	}

	/**
	 * Delete Storage Image
	 *
	 * @param string	$imageName	Image name, that to be deleted
	 * @param string	$type		Image type. DEFAULT `avatar`
	 * @return boolean
	 */
	public static function deleteStorageImage($image, $type = 'avatar')
	{
		try {
			$image = \is_array($image) ? $image : [$image];

			foreach ($image as $imageName) {
				if ($imageName && $imageName != self::{$type}()) {
					File::delete(\storage_path("app/public/" .$imageName));
                }
			}

			return true;
		} catch (\Throwable $th) {}

		return false;
	}
}
