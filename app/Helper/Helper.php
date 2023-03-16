<?php

namespace App\Helper;

/**
 * Main Helper Class
 *
 */
class Helper
{
    /**
	 * Get Variables that are allocated into called Class
	 *
	 * @param string	$method	Statically called method
	 * @param	array		$arg		Method arguments
	 *
	 * @return array|bool
	 */
	public static function __callStatic($method, $arg)
	{
		$data = false;

		if (! isset(self::childClass()::${$method})) {
			return $data;
		}

		$data = self::childClass()::${$method};

		if(! $arg) {
			return $data;
		}

		switch(count($arg)) {
			case '1':
				if (in_array(current($arg), $data)) {
					return true;
				}

				return false;
			break;
			case '2':
				$key = \current($arg);
				$flag = strtoupper(\next($arg));

				if ($flag == 'EXISTS' && \array_key_exists($key, $data)) {
					return true;
				}

				if ($flag == 'DIFF') {
					$key = is_array($key) ? $key : [$key];

					return array_diff($data, $key);
				}

				return false;
			break;
		}
		
		return false;
	}

	/**
	 * Return Called from Class name
	 *
	 * @return string
	 */
	private static function childClass()
	{
		return \get_called_class();
	}

	/**
	 * Check value into $checkAndRadio and convert into Bangali
	 *
	 * @param object	$ctx				DataContext from Database
	 * @param array		$sets				dataset that to be checked and converted
	 * @param string	$key				Checking key
	 * @param string	$separator			Values are separated with
	 *
	 * @return string
	 */
	public static function check($ctx, $sets, $key  = 'on', $separator = ', ')
	{
		$context = self::childClass();
		$setStore = [];

		foreach ($sets as $set) {
			if (($ctx->{$set} == $key) && isset($context::$checkAndRadio[$set])) {
				$setStore [] = $context::$checkAndRadio[$set];
			}
		}
		return $setStore ? implode($separator, $setStore) : "";
	}

	/**
	 * Return Checked in case of checkbox methods
	 *
	 * @param string	$value	Value that to be checked
	 * @param string	$with		Compared with $value
	 *
	 * @return string
	 */
	public static function checker($value, $with)
	{
		return $value == $with ? 'checked' : "";
	}

	/**
	 * Return value from given array key
	 *
	 * @param string	$field_name	Input/DataBase field name:attribute
	 * @param string	$needle			Key that to be found as field_named key
	 * @param string	$default		IF value not found
	 *
	 * @return string
	 */
	public static function get( $field_name, $needle, $default = "-" )
	{
		$context = self::childClass();

		return isset($context::${$field_name}[$needle])
					? $context::${$field_name}[$needle]
					: $default;
	}

	/**
	 * Select Field To be Selected
	 *
	 * @param array|string	$field_name		Input/Maid form field name:attribute
	 * @param string		$needle			Key that will be selected as field_named key
	 * @param string		$count			Count number of options will be returned
	 * @param string		$avoidValue		Avoid values to be shown
	 * @return string
	 */
	public static function select($field_name, $needle = "", $count = 0, $avoidValue = [])
	{
		$i = 0;
		$option = "";
		$context = self::childClass();
		$select = \is_array($field_name) ? $field_name : ($context::${$field_name} ?? []);

		if (! $select) {
			return $option;
		}

		$needle = ! \is_array($needle) ? [$needle] : $needle;
		$count = $count ?: count($select);

		if (! \is_array($avoidValue)) {
			$avoidValue = [$avoidValue];
		}

		foreach ($select as $key => $s) {
			if ($i < $count && ! \in_array($s, $avoidValue)) {
				$option .= "<option value = '{$key}'".(in_array($key, $needle) ? " selected" : "").">{$s}</option>";
				$i++;
			}
		}

		return $option;
	}
}
