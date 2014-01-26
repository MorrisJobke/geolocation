<?php

/**
 * Geolocation class for Google geolocation API
 *
 * @author		Morris Jobke <morris.jobke@gmail.com>
 * @copyright	2014 Morris Jobke
 * @license		http://opensource.org/licenses/mit-license.php The MIT License
 */

include_once('geolocation.php');

class GoogleGeolocation extends Geolocation {

	protected $apiUrl = 'https://www.googleapis.com/geolocation/v1/geolocate?key=%s';

}
