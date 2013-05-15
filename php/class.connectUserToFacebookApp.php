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

 
class connectUserToFacebookApp extends ConnectToFacebook
{
	
	public function __construct($_fbAppID,$_fbAppSecret) {
		
		parent::__construct($_fbAppID,$_fbAppSecret);
		
		$this->getFacebookProfile();
	}
	
	private function getFacebookProfile()
	{
		$_facebookApploginUrl=null;
		$_isFacebookAppConnected=false;
		$_user_profile=null;
		$_user_image=null;
		$_user = $this->__facebook->getUser();
	
		if ($_user <> '0' && $_user <> '')
		{ 			
			  try
			  {
				// get user profile
				$_user_profile = $this->__facebook->api('/me');
				$_user_image =   $this->__facebook->api("/me?fields=picture");
				$_user_name = $_user_profile['name'];
				$_isFacebookAppConnected=true;

			  } catch (FacebookApiException $e) {

					// catch errors from Facebook API quietly
					$_user = "Error";
					$_isFacebookAppConnected=false;

			  }

		} else {

		// create redirect url to connect app to user
			$_isFacebookAppConnected=false;
			$_params = array(
			  'scope' => 'publish_stream,email,user_likes',
			  'redirect_uri' => $this->__config->get('fbURL')
			);

			$_facebookApploginUrl = $this->__facebook->getLoginUrl($_params);
		}
		
		$this->set('facebookAppConnected', $_isFacebookAppConnected);	
		$this->set('facebookApploginUrl', $_facebookApploginUrl);
		$this->set('facebookUserName', $_user_name);	
		$this->set('facebookProfile', $_user_profile);
		$this->set('facebookImage', $_user_image);
	}

}