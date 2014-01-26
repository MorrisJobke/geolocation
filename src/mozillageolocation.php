<?php

/**
 * Geolocation class for Mozilla geolocation API
 *
 * @author		Morris Jobke <morris.jobke@gmail.com>
 * @copyright	2014 Morris Jobke
 * @license		http://opensource.org/licenses/mit-license.php The MIT License
 */

include_once('geolocation.php');

class MozillaGeolocation extends Geolocation {

	protected $apiUrl = 'https://location.services.mozilla.com/v1/geolocate?key=%s';

}
