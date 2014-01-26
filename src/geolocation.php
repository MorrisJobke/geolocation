<?php

/**
 * Geolocation class for Mozilla|Google geolocation API
 *
 * @author		Morris Jobke <morris.jobke@gmail.com>
 * @copyright	2014 Morris Jobke
 * @license		http://opensource.org/licenses/mit-license.php The MIT License
 */

class Geolocation {

	protected $apiUrl;
	protected $apiKey;

	public function Geolocation($apiKey){
		$this->apiKey = $apiKey;
	}

	/**
	 * retrieves the geolocation from the service
	 *
	 * @param Array $wifiAccessPoints BSSIDs of all visible accesspoint
	 * @return Array location (lat, lng) and accuracy
	 *		{
	 *			"location": {
	 *				"lat": 51.0,
	 *				"lng": -0.1
	 *			},
	 *			"accuracy": 1200.4
	 *		}
	 * 		OR
	 *		String error reason
	 */
	public function getCoordinates($wifiAccessPoints){
		$mappedWifiAccessPoints = array_map(
			function($value){
				return array("macAddress" => $value);
			},
			$wifiAccessPoints
		);

		$data = array(
			'wifiAccessPoints' => $mappedWifiAccessPoints
		);
		$url = sprintf($this->apiUrl, $this->apiKey);

		// setup curl options
		$ch = curl_init();

		curl_setopt_array($ch, array(
			CURLOPT_URL => $url,
			CURLOPT_POST => true,
			CURLOPT_HEADER => false,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_SSL_VERIFYHOST => 2,
			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json'
			),
			CURLOPT_POSTFIELDS => json_encode($data)
		));

		$result = curl_exec($ch);

		$data = json_decode($result, true);

		if(array_key_exists('error', $data)){
			return $data['error']['errors'][0]['reason'];
		}

		return $data;
	}

}
