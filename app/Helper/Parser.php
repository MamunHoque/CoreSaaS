<?php

namespace App\Helper;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;

/**
 * Parse data from Array field set are provided value by key
 */
class Parser
{
	/**
	 * Data Set in which all data will be stored
	 * 
	 * @var \Illuminate\Database\Eloquent\Model
	 */
	private $set;

	/**
	 * Cities
	 * 
	 * @var array
	 */
	private static $cities = [];

	/**
	 * Class constructor
	 * 
	 * @param	\Illuminate\Database\Eloquent\Model	$set
	 * @return void
	 */
	public function __construct(?Model $set)
	{
		$this->set = $set;
	}

	/**
	 * Get data from model or old
	 */
	public function __get($name) {
		if (empty($this->set) && ! old()) {
			return null;
		}

		if (! old()) {
			return $this->set->{$name};
		}

		if ($name == 'id') {
			return $this->set->id;
		}
		
		return old($name);
	}

	/**
	 * Change to percent
	 * 
	 * @param int	$compare		Value to be made in percent
	 * @param int	$head			Value to be compared with
	 * 
	 * @return int|string
	 */
	public static function percent($compare, $head)
	{
		$head = $head != 0 ? $head : 1;

		return round($compare * 100/ $head);
	}

	/**
	 * Wrap text with first bracket
	 * 
	 * @param string	$text		String that to be wrapped
	 * @return string
	 */
	public static function wrap($text)
	{
		return $text ? "({$text})" : "";
	}

	/**
	 * Generate Random String by table field
	 * 
	 * @param string	$table
	 * @param string	$field
	 * @param int		$length
	 * @return string
	 */
	public static function random($table, $field, $length = 12)
	{
        $number = Str::random($length);

        $validator = Validator::make(
			['id' => $number],
			['id'=> "unique:{$table},{$field}"]
		);

        if ($validator->fails()) {
            return self::random($table, $field, $length);
		}
		
        return $number;
    }

	/**
	 * Generate Random number by table field
	 * 
	 * @param string	$table
	 * @param string	$field
	 * @param int		$min
	 * @param int		$max
	 * @return int
	 */
	public static function randomNumber($table, $field, $min, $max)
	{
        $number = mt_rand($min, $max);

        $validator = Validator::make(
			['id' => $number],
			['id'=> "unique:{$table},{$field}"]
		);

        if ($validator->fails()) {
            return self::random($table, $field, $min, $max);
		}
		
        return $number;
    }

	/**
	 * Count given days in given date range
	 * 
	 * @param string		$weekDay
	 * @param string|array	$date		Start
	 * @param array	$endDate	End date. NOT required
	 * @return	int
	 */
	public static function countDayInWeek($weekDay, $date, $endDate = [])
	{
		if (is_string($date)) {
			$date = explode('-', $date);
		}

		$date[2] = 01;
		$days = Carbon::create(...$date)->daysInMonth + 1;

		if (empty($endDate)) {
			$endDate = $date;
			$endDate[2] = $days;
		}

		$startDate = Carbon::create(...$date);
        $endDate = Carbon::create(...$endDate);

        $daysForExtraCoding = $startDate->diffInDaysFiltered(function(Carbon $date) use($weekDay) {
			return $date->is($weekDay);
        }, $endDate);
		
        return $daysForExtraCoding;
	}

	/**
	 * Figure out language
	 * 
	 * @param string $english
	 * @param string $notEnglish
	 * @param mixed
	 */
	public static function ln($english, $notEnglish = null)
	{
		if (empty($notEnglish) && is_string($english)) {
			$notEnglish = "{$english}De";
		}

		if (App::isLocale('en')) {
			return $english;
		}
		
        return $notEnglish;
	}

	/**
	 * Rescue Lat long
	 * 
	 * @param string									$latLon
	 * @param \Illuminate\Database\Eloquent\Model|null	$lat
	 * @param null|mixed								$lon
	 */
	public static function rescueLatLon($latLon, &$lat = null, &$lon = null)
	{
		if (! preg_match('/^(?<lat>\d+[\.]\d+)[\,](?<lon>\d+[\.]\d+)$/', preg_replace('/\s+/', '', $latLon), $match)) {
			return null;
		}

		if ($lat instanceof Model) {
			$lat->{'lat'} = $match['lat'];
			$lat->{'lon'} = $match['lon'];

			return;
		}

		$lat = $match['lat'];
		$lon = $match['lon'];
	}

	/**
	 * Rescue Cities of Netherland
	 * 
	 * @param string	$clue
	 * @param int		$length
	 * @return array
	 */
	public static function rescueCities($clue = "", $length)
	{
		if (empty(self::$cities)) {
			$file = storage_path("jsons/cities.json");
        	self::$cities = json_decode(file_get_contents($file));
		}

		if (empty($clue)) {
			return self::$cities;
		}

		$match = array_filter(self::$cities, function($value) use($clue) {
			return strpos(strtolower($value), strtolower($clue)) !== false;
		});

		return array_slice($match, 0, $length);
	}
}
