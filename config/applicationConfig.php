<?php
/**
 *  Configuration file for Facebook/Magento
 *  Social Media marketing application that
 *  awards customers who like a Facebook page
 *  with a configurable Magento discount coupon.
 *  
 *  Copyright (C) 2013 paj@gaiterjones.com
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
	require_once './php/class.Facebook.php';
	require_once './php/class.ConnectToFacebook.php';
	require_once './php/class.connectUserToFacebookApp.php';
	require_once './php/class.PostToUsersFacebookWall.php';
	require_once './php/class.DecodeSignedLikeRequest.php';
	require_once './php/class.Page.php';
	require_once './php/class.PageMain.php';
	require_once './php/class.PageMainData.php';
	require_once './php/class.PageMainHTML.php';
	require_once './php/class.DB.php';
	require_once './php/class.DBUser.php';
	require_once './php/class.DBWallPost.php';
	require_once './php/class.GenerateMagentoCoupon.php';
	require_once './php/class.Application.php';
	require_once './php/class.GenerateDiscountCode.php';	
	require_once './php/class.ErrorHandler.php';	

// Setup error handling
error_reporting(0);
// handle uncaught exceptions
set_exception_handler( array( 'Error', 'captureException' ) );

// debugging
//error_reporting(E_ALL);
//set_error_handler( array( 'Error', 'captureNormal' ) );
//register_shutdown_function( array( 'Error', 'captureShutdown' ) );



// Edit configuration settings here - enter credentials, passwords etc in the credentials config file.
//
//
class config
{

	protected $__;
	
	// page title - valid when viewing the page
	// standalone, i.e. outwith facebook
	const pageTitle = 'Magento Discounts for Likes Demo';
	// page description
	const pageDescription = 'Description for my page.';
	// The URL to where this applications index.php is located
	const appURL = 'https://www.medazzaland.co.uk/dev/git/magento-facebook-discount-for-likes/';
	// The URL to the facebook page or tab
	const fbURL = 'https://www.facebook.com/pages/gaiterjones/243428839036258?sk=app_375000545898475';
	// image file to use as an icon for facebook wallposts etc.
	const appIcon = 'magento-icon.png';
	// application name
	const appName = 'Magento Discounts for Likes Demo';
	// Magento store name
	const storeName = 'My Magento Store';
	// URL of your Magento store
	const storeURL = 'http://dev.gaiterjones.com/magento';
	// Magento store URL
	const wallPostCaption = 'Like this page and grab a discount!';
	// Text to use for wallposts
	const wallPostMessage = 'Demonstration of a Social Media marketing application that rewards customers who like a Facebook page with a configurable Magento discount coupon.';
	// page will load standalone if set to true, will redirect to Facebook fbURL (configured above) if set to false.
	const allowStandAlone = false;
	// if app connected - user must also like page to see content
	const pagelikerequired = true;	
	// enable/disable customer wall posts when discount code is issued
	const allowWallPosts = true;
	// banners to use on main page
	// 1 - Like this page to continue
	const couponBanner1 = 'discountvoucher1.png';
	// 2 - Display code
	const couponBanner2 = 'discountvoucher2.png';
	// 3 - Code already issued
	const couponBanner3 = 'discountvoucher3.png';
	// 4 - error detected
	const couponErrorBanner = 'discountvoucher4.png';
	// description of coupon - appears in magento admin
	const couponDescription = 'Description for my coupon.';
	// coupon value i.e. 15 for $15 discount
	const couponValue = '15';
	// validity of coupon in days, i.e. 30 = coupon expires in 30 days. Leave blank for coupon that does not expire.
	const couponValidty = '30';
	// coupon prefix, leave blank for no prefix or specify prefix, useful for identifying/grouping coupons in Magento admin
	const couponPrefix = 'FB';
	// coupon customer group ids, set group ids the coupon is valid for.
	const couponCustomerGroups = '0,1';

	// path to root magento installation folder	
	const PATH_TO_MAGENTO_INSTALLATION = '/home/www/dev/magento/';
	// show the comments facebook plugin - used by the demo
	const showComments = true;
	// show the demo info box set this to false for production
	const demo = true;
	// text for demo info box
	const demoText =	'This is a demonstration of a Social Media marketing Facebook application that
						rewards customers who like a Facebook page with a configurable Magento discount coupon.
						Compatible with Magento Community Editions 1.3 - 1.7. Demo store running Magento CE 1.7.0.0.
						Please try the discount code out and leave comments or suggestions for development below.';

	
	
	
	public function __construct()
	{
		$_applicationCredentialsFile='/home/www/dev/'. strtolower(str_replace(' ', '-', self::appName)). '-applicationCredentials.php';
		
		if (file_exists($_applicationCredentialsFile)) {
			require_once $_applicationCredentialsFile;
		} else {
			require_once './config/applicationCredentials.php';
		}
		
		// load app credentials
		applicationCredentials::load();
	
	}
	
	
    public function get($constant) {
	
	    $variable=$constant;
		$constant = 'self::'. $constant;
	
	    if(defined($constant)) {
		
	        return constant($constant);
	    
		} else {
			
			return $this->__[$variable];
			
	    }

	}
	
	public function set($key,$value)
	{
		$this->__[$key] = $value;
	}	
}

// autoloader disabled

//function autoloader($class) {
//	require_once 'php/class.' . $class . '.php';
//}
//spl_autoload_register('autoloader');
?>