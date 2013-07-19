<?php
/**
 *  Social Media marketing application that
 *  rewards customers who like a Facebook page
 *  with a configurable Magento discount coupon.
 *  
 *  v0.2.0 - 15.05.2013
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

/* Main application class */
class Application
{
	
	protected $__;
	protected $__config;
	
	public function __construct() {
		
		try
		{
			$this->set('errorMessage',false);
			$this->loadConfig();
			$this->connectToFacebook();
			$this->getLikeStatus();
			$this->processDiscount();
			$this->renderPage();
		
		}
		catch (Exception $e)
	    {
	    	$this->set('errorMessage', 'An error has occurred : '. $e->getMessage(). ' <a class="fancybox" href="#errorReport">!</a>
			<div id="errorReport" style="display: none;">Error trace (if available) - <pre>'. $e->getTraceAsString(). '</pre></div>');
	    	$this->set('discountCode', false);
	    	$this->renderPage();
	    	exit;
	    }
	}

	private function loadConfig()
	{
		$this->__config= new config();
		
		// init class variables
		$this->set('facebookAppConnected', false);
		$this->set('discountCode', false);
		$this->set('likeStatus', false);
		$this->set('discountCodeAlreadyIssued', false);
		
		$this->set('languagecode',$this->getBrowserLanguage()); // language set from BROWSER
	}

	private function connectToFacebook()
	{
		$facebook = new connectUserToFacebookApp($this->__config->get('fbAppID'),$this->__config->get('fbAppSecret'));
		$this->set('facebookAppConnected',$facebook->get('facebookAppConnected'));
		$this->set('facebookApploginUrl', $facebook->get('facebookApploginUrl'));
		$this->set('facebookUserName', $facebook->get('facebookUserName'));
		$this->set('facebookProfile', $facebook->get('facebookProfile'));
		$this->set('facebookImage', $facebook->get('facebookImage'));
		unset($facebook);
	}
	
	private function getLikeStatus()
	{

		if ($this->__['facebookAppConnected']) {
		
			$likeStatus=new DecodeSignedLikeRequest($this->__config->get('fbAppSecret'));
				$this->set('likeStatus',$likeStatus->get('likeStatus'));
					unset($likeStatus);
		}
	}

	private function processDiscount()
	{

		if ($this->__['likeStatus']) {

			// create a discount code
			$this->generateDiscountCode();
			
			// update user record
			$user= new DBUSer($this->__['facebookProfile'],$this->__['facebookImage'],$this->__['discountCode']);
			$_newCustomer=$user->get('newUser');
			$_customerID=$user->get('id');
			unset($user);
			
			if ($_newCustomer)
			// new Customer
			{
				if (!empty($this->__['discountCode']))
				{
					// generate Magento coupon
					$this->generateMagentoCoupon();
					
					// facebook wall post
					$this->facebookWallPost($_customerID);
				
				} else {
					// empty code = discountCode error detected
					$this->set('errorMessage','An error occurred creating the discount code.');
				}
				
			} else {
				// Existing customer
				$this->set('discountCode', false);
				$this->set('discountCodeAlreadyIssued', true);
				$this->set('discountCodeMessage','A discount code has already been issued to '. $this->__['facebookUserName']);
			}
			
		} 
	}

	private function facebookWallPost($_customerID)
	{
		if ($this->__config->get('allowWallPosts'))
		{
			$wallPost= new DBWallPost();
			// get wallpost status
			$wallPost->wallPostStatus('get',$_customerID);
			
			$_wallPostStatus=$wallPost->get('wallPostStatus');
			
			if ($_wallPostStatus) // post to wall
			{
				$post=new PostToUsersFacebookWall($this->__config->get('fbAppID'),$this->__config->get('fbAppSecret'));
				// set wallpost flag to true
				$wallPost->wallPostStatus('set',$_customerID);
			}
			
			unset($wallPost);
		}
	}
	
	private function generateDiscountCode()
	{
		$obj = new GenerateDiscountCode($this->__config->get('couponPrefix'));
			$this->set('discountCode', $obj->get('discountCode'));
				unset($obj);
	}
	
	private function generateMagentoCoupon()
	{
		$obj = new GenerateMagentoCoupon($this->__['discountCode']);
			unset($obj);
	}

	public function getBrowserLanguage() {
	
		if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE']))
		{
			foreach (explode(",", strtolower($_SERVER['HTTP_ACCEPT_LANGUAGE'])) as $accept) {
				if (preg_match("!([a-z-]+)(;q=([0-9.]+))?!", trim($accept), $found)) {
					$langs[] = $found[1];
					$quality[] = (isset($found[3]) ? (float) $found[3] : 1.0);
				}
			}
			// Order the language codes
			array_multisort($quality, SORT_NUMERIC, SORT_DESC, $langs);
			
			$_languageCode=explode('-',$langs[0]);
			$_languageCode=$_languageCode[0];
			return strtolower($_languageCode);
			
		} else {
		
			return 'en';
		}
	    
    }		

	private function renderPage()
	{
		// ouput methods
		// 1. HTML
		
		$this->set('requestedpage','main');
		
		// get Page class
		$_pageClass=explode('-',$this->get('requestedpage'));
		$_requestedPage=$_pageClass[0];
		$_requestedSubPage=null;
		
		if (isset($_pageClass[1])) { $_requestedSubPage=$_pageClass[1]; }
		
		$_pageClass='Page'.ucfirst($_requestedPage);
		
		if (!file_exists('php/class.' . $_pageClass . '.php')) { throw new exception('Requested page class '. $_pageClass. ' is not valid.'); }
		
		$_page = new $_pageClass(array(
		  "facebookApploginUrl"  => $this->__['facebookApploginUrl'],
		  "discountCode" => $this->__['discountCode'],
		  "discountCodeMessage" => $this->__['discountCodeMessage'],
		  "discountCodeAlreadyIssued" => $this->__['discountCodeAlreadyIssued'],
		  "errorMessage" => $this->__['errorMessage'],
		  "facebookAppConnected" => $this->__['facebookAppConnected'],
		  "languagecode" => $this->__['languagecode'],
		  "likestatus" => $this->__['likeStatus']
		));		

		echo $_page;
		
		unset($_page);
	}
	
	public function set($key,$value)
	{
		$this->__[$key] = $value;
	}
		
  	public function get($variable)
	{
		return $this->__[$variable];
	}
	
}
