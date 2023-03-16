<?php
namespace App\Helper;

use DateTime;

/**
 * Format data by requirement
 */
class Format
{
	/**
	 * Value of time
	 */
	private static $time = '';

	/**
	 * Value of dateTime
	 */
	private static $dateTime = '';

	public static function attachDateTime($date, $time)
	{
		try {
			$date = (new \DateTime($date))->format('Y-m-d');
			$time = (new \DateTime($time))->format('H:i:s');
			
			return "{$date} {$time}";
		} catch (\Throwable $th) {
			return $date;
		}
	}

	/**
	 * Change Single name to Label, joined with [\_]
	 *
	 * @param string	$label	Main String
	 *
	 * @return string
	 */
	public static function label($label)
	{
		return \ucfirst(\preg_replace('/\_/', ' ', $label));
	}

	/**
	 * Change sentence into a single string
	 *
	 * @param string	$name	Main String
	 *
	 * @return string
	 */
	public static function toSingle($name)
	{
		return \preg_replace('/\s+/', '', $name);
	}

	/**
	 * Beautify date of time string
	 *
	 * @param string $format		Date/Time format. DEFAULT ""
	 * @return string						Formatted date/time string
	 */
	public static function beautify($format = "")
	{
		if (! self::$dateTime && ! self::$time) {
			return "";
		}

		// Incase of datetime
		
		if (self::$dateTime) {
			$date = new \DateTime(self::$dateTime);
			self::$dateTime = "";

			return $date->format($format ?: 'd M, Y (h:i a)');
		}

		// Incase of time

		if (\is_numeric(self::$time)) {
			return ((int) self::$time ? (int) self::$time ."h " : "")
				. round((self::$time - (int) self::$time) *60) .'m';
		}
		
		if (\is_array(self::$time)) {
			$formatted_time = [];

			foreach (self::$time as $time) {
				try {
					$date = new \DateTime($time);
					$formatted_time [] = $date->format($format ?: 'h:i a');
				} catch (\Throwable $th) {
					$formatted_time [] = "00:00:00";
				}
			}
			
			self::$time = "";
			
			return $formatted_time;
		}
		
		try {
			$date = new \DateTime(self::$time);
			self::$time = "";

			return $date->format($format ?: 'h:i a');
		} catch (\Throwable $th) {
			return "00:00:00";
		}
	}

	/**
	 * Return date only
	 *
	 * @param string		$format		Output date format string
	 * @return string							Formatted date/time string
	 */
	public static function date($format = 'Y-m-d')
	{
		try {
			$date = new \DateTime(self::$dateTime);
			self::$dateTime = "";

			return $date->format($format);
		} catch (\Throwable $th) {}

		return "";
	}

	/**
	 * DateTime string that to be formatted
	 *
	 * @param string $dt		DateTime string. Formatted	xx-xx-xx xx:xx:xx
	 * @return self
	 */
	public static function dateTime($dt)
	{
		self::$dateTime = $dt;
		self::$time = "";

		return new self;
	}

	/**
	 * Time string that to be formatted
	 *
	 * @param string $time		Time string. Formatted	xx:xx:xx
	 * @return self
	 */
	public static function time($time)
	{
		self::$time = $time;
		self::$dateTime = "";

		return new self;
	}

	/**
	 * Increase time by hours
	 *
	 * @param float $upTo		Hours to be upped
	 * @return string 			formatted time
	 */
	public static function up($upTo, $format = 'h:i a')
	{
		try {
			if (self::$time) {
				$date = new \DateTime(self::$time);
				$date->add(new \DateInterval('PT'.((float)$upTo *60).'M'));

				return $date->format($format);
			}

			$upTo = \is_string($upTo) ? $upTo : 'P'.$upTo.'D';
			$date = new \DateTime(self::$dateTime);
			$date->add(new \DateInterval($upTo));

			return $date->format($format);
		} catch (\Throwable $th) {}

		return "";
	}

	/**
	 * Decrease dateTime
	 *
	 * @param float $upTo		Hours to be upped
	 * @return string 			formatted time
	 */
	public static function down($downTo, $format = 'Y-m-d H:i:s')
	{
		try {
			$date = new DateTime(self::$dateTime);
			$downTo = \is_string($downTo) ? $downTo : "-" .abs($downTo). " day";

			return $date->modify($downTo)->format($format);
		} catch (\Throwable $th) {
			return $th->getMessage();
		}

		return "";
	}
	
	/**
	 * Time Different
	 *
	 * @return int
	 */
	public function diff($ended)
	{
		$time = self::$time;
		self::$time = "";

		try {
			$to_time = strtotime($time);
			$from_time = strtotime($ended);

			return round(abs($to_time - $from_time) / (60), 2);
		} catch (\Exception $ex) {}

		return 0;
	}

	/**
	 * Create a formatted date range from 2 date
	 * 
	 * @param string	$from		Date from
	 * @param string	$to			Date to
	 * @param string	$format		Date to
	 * @param string	$separator	range separator. DEFAULT -
	 * @return string
	 */
	public static function createDateRange($from = "", $to = "", $format = 'm/d/Y', $separator = '-')
	{
		if (empty($from) || empty($to)) {
			return "";
		}

		try {
			$from = (new \DateTime($from))->format($format);
			$to = (new \DateTime($to))->format($format);
	
			return trim("{$from} {$separator} {$to}", ' ');
		} catch (\Throwable $th) {
			return "";
		}
	}

	/**
	 * Get a string and divide into two date
	 * 
	 * @param string	$date		Ranged date string
	 * @param string	&$start		Start Date Reference
	 * @param string	&$end		End Date Reference
	 * @param null|int	$part		Part of date start or end
	 * @param string	$separator	Date Separator, DEFAULT '-'
	 * @return mixed
	 */
	public static function rescueDateRange($date, &$start = null, &$end = null, $part = null, $separator = '-')
	{
		if (empty($date)) {
			$start = date('Y-m-d');
			$end = date('Y-m-d');
			
			return;
		}

		$date = explode($separator, \preg_replace('/\s+/', '', $date));

		if (\is_null($part)) {
			if ($date) {
				foreach ($date as $i => $d) {
					$date[$i] = self::dateTime($d)->beautify('Y-m-d');
				}
			}
			
			$start = isset($date[0]) ? $date[0] : null;
			$end = isset($date[1]) ? $date[1] : null;

			return $date;
		}

		return isset($date[$part])
				? self::dateTime($date[$part])->beautify('Y-m-d')
				: null;
	}

	/**
	 * Sort date Set asc
	 * 
	 * @param array &$dates
	 * @return array
	 */
	public static function sortDateAsc(array &$dates)
	{
		usort($dates, function($a, $b) {
			$a = date('Y-m-d', strtotime($a));
			$b = date('Y-m-d', strtotime($b));
		
			if ($a == $b) {
				return 0;
			}
			return ($a < $b) ? -1 : 1;
		});

		return $dates;
	}
}
