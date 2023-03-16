<?php

namespace App\Helper;

use App\Models\OrderAddress;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

/**
 * Parse data from Array field set are provided value by key
 */
class Curl
{
	/**
	 * Send a curl request
	 * 
	 * @param string $url
	 * @return sttClass|null
	 */
	public function send($url)
	{
		$response = null;

		try {

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			$response = curl_exec($ch);
			curl_close($ch);

		} catch (\Throwable $th) {}

		return json_decode($response);
	}
	
	/**
	 * Get response by Way key value
	 * 
	 * @param string|null	$value
	 * @param stdClass		$response
	 * @return mixed
	 */
	public function dispatchResponse($value, $response)
	{
		if (empty($value)) {
			return $response;
		}

		foreach(explode('.', $value) as $key) {
			$response = is_numeric($key) ? $response[$key] : $response->{$key};
		}

		return $response;
	}

	/**
	 * Get Location from google api
	 * 
	 * @param string 	$house
	 * @param string 	$street
	 * @param string 	$city
	 * @param string 	$postalCode
	 * @param string 	$value		// separated with \. Ex - person.name
	 * @return null|stdClass
	 */
	public function getLocation($house, $street, $city, $postalCode, $value = null)
	{
		$address = urlencode(implode(', ', [
			$house, $street, $city, $postalCode
		]));
		
		$endPoint = "https://maps.googleapis.com/maps/api/place/findplacefromtext/json";
		$params = implode('&', [
			"input={$address}",
			"inputtype=textquery", 
			"fields=photos,formatted_address,name,rating,opening_hours,geometry",
			"key=".config('app.map_api_key')
		]);
		
		$response = $this->send("{$endPoint}?{$params}");

		if (empty($response) || $response->status !== 'OK') {
			return null;
		}

		return $this->dispatchResponse($value, $response);
	}

	/**
	 * Get route information
	 * 
	 * @param \Illuminate\Database\Eloquent\Collection	$stops
	 * @param null|string				$value
	 * @return 
	 */
	public function getRoute($stops, $value = null)
	{
		if ($stops->count() > 0) {
            $start = '';
            $end = '';
            $waypoints = [];

            $stops->map(function($stop) use(&$waypoints) {
                $waypoints[] = "{$stop->lat},{$stop->lon}";
            });
			
            if (empty($start)) {
                $start = current($waypoints);
                array_shift($waypoints);
            }
            if (empty($end)) {
                $end = end($waypoints) ?: $start;
                array_pop($waypoints);
            }

            $waypoints = implode('|', $waypoints);

            $query = [
                "origin={$start}",
                "destination={$end}",
                "waypoints={$waypoints}",
				"mode=driving",
                "key=". config('app.map_api_key')
            ];

            $response = $this->send("https://maps.googleapis.com/maps/api/directions/json?" . implode('&', $query));

			if (empty($response) || $response->status !== 'OK') {
				return null;
			}

            return $this->dispatchResponse($value, $response);
        }
	}
}
