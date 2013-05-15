<?php
/**
 *  
 *  Copyright (C) 2012 paj@gaiterjones.com
 *
 *	This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 *  @category   PAJ
 *  @package    
 *  @license    http://www.gnu.org/licenses/ GNU General Public License
 * 	
 *
 */

 
class DecodeSignedAppData
{
	
	protected $__;
	
	public function __construct($_fbAppSecret) {
		
		$this->getAppData($_fbAppSecret);
	
	}
	
	private function getAppData($_fbAppSecret)
	{
		$this->set($_key,false);
	
		// decode signed request for facebook like
		$_signed = $this->parse_signed_request($_REQUEST['signed_request'], $_fbAppSecret);

		// determine like status
		$this->set('appData',$_signed["app_data"]);

	}

	public function set($key,$value)
	{
		$this->__[$key] = $value;
	}
		
	public function get($variable)
	{
		return $this->__[$variable];
	}

	private function parse_signed_request($signed_request, $secret) {
	    list($encoded_sig, $payload) = explode('.', $signed_request, 2);

	    // decode the data
	    $sig = $this->base64_url_decode($encoded_sig);
	    $data = json_decode($this->base64_url_decode($payload), true);

	    if (strtoupper($data['algorithm']) !== 'HMAC-SHA256') {
	        error_log('Unknown algorithm. Expected HMAC-SHA256');
	        return null;
	    }

	    // check sig
	    $expected_sig = hash_hmac('sha256', $payload, $secret, $raw = true);
	    if ($sig !== $expected_sig) {
	        error_log('Bad Signed JSON signature!');
	        return null;
	    }

	    return $data;
	}

	private function base64_url_decode($input) {
	    return base64_decode(strtr($input, '-_', '+/'));
	}
	
}
