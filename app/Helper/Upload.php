<?php

namespace App\Helper;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

/**
 * Upload Any image
 */
class Upload
{
	public static $photo;
	public static $image_name = null;

	/**
	 * Initiate global variables
	 * 
	 * @return void
	 */
	private static function init()
	{
		self::$photo = null;
		self::$image_name = null;
	}

	/**
	 * Upload an image from base64 string
	 * 
	 * @param 	string	$base64			Base64 string
	 * @param	string	$path			file path
	 * @param	string	$nameSuffix		File name suffix
	 * @return 	string
	 */
	public static function fromBase64($base64, $path, $nameSuffix = "")
	{
		preg_match_all('/^(data:image[\/])(?<type>png|jpg|jpeg)[\;]base64/', $base64, $match);

		if (! isset($match['type']) || empty($match['type'])) {
			return '';
		}

		$extension = current($match['type']);  // .jpg .png .pdf

		$image = preg_replace(["/data:image[\/]{$extension}[\;]base64[\,]/", '/\s+/'], ['', '+'], $base64);

		$imageName = trim($path, '/') .'/'. md5(date('Y_m_d_H_i_s').\rand(11111111, 99999999)). $nameSuffix. '.'.$extension;

		Storage::disk('public')->put($imageName, base64_decode($image));

		return $imageName;
	}

	/**
	 * Image upload to public directory
	 * 
	 * @param object	$request		request object
	 * @param	string	$file				request file names
	 * @param	string	$id					prefix id of new image name
	 * @param	string	$subDir			nested directory of public image directory
	 * 
	 * @return object
	 */
	public static function publicImage($request, $file, $id = "", $subDir = "")
	{
		$subDir = trim($subDir, "/") ."/";

		if (empty($request->file($file))) {
			return "";
		}

		$photo = $request->file($file);
		$image_name = $id.md5(time()).".".$photo->getClientOriginalExtension();
		$photo->move(\public_path("/images/{$subDir}"), $image_name);

		return $subDir.$image_name;
	}
		
	/**
	 * Uploaded image details
	 * 
	 * @param object	$request		request object
	 * @param	string	$file				request file names
	 * @param	string	$id					prefix id of new image name
	 * 
	 * @return object
	 */
	public static function image($request, $file, $id = "")
	{
		self::init();

		if (empty($request->file($file))) {
			return new self;
		}

		if (empty($id)) {
			$id = rand(10000, 99999);
		}

		self::$photo = $request->file($file);
		self::$image_name = $id.md5(time()).".".self::$photo->getClientOriginalExtension();

		return new self;
	}
	
	/**
	 * Move image to given storage directory
	 * 
	 * @param string $dir			storage image directory, in where image will be moved
	 * @param string $$extra_path	Path before file name
	 * 
	 * @return bool
	 */
	public function to($dir, $extra_path = "")
	{
		$moved = null;

		if ($extra_path) {
			$extra_path = trim($extra_path, '/') . '/';
		}

		if (self::$image_name) {
			$moved = self::$photo->move(\storage_path("app/public/{$extra_path}{$dir}"), self::$image_name)
						? trim($dir,'/').'/'.self::$image_name
						: null;
		}
		
		self::init();

		return $moved;
	}

	/**
	 * Clear old Storage file by name
	 * 
	 * @param string	$old
	 * @param string	$new
	 * @return	bool
	 */
	public static function clearOldStorage($old, $new)
	{
		if (empty($old) || $old === $new) {
			return true;
		}

		return File::delete(\storage_path("app/public/" .$old));
	}
}
