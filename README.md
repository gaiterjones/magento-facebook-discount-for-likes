## Magento Discount Coupon Code for Facebook Likes
***

Live demo at [https://www.facebook.com/pages/gaiterjones/243428839036258](http://)

### Synopsis
The Facebook “Like” is an important Social Media Marketing tool. It instills customer confidence and enables new marketing opportunities. Increasing the number of likes your e-Commerce site has can sometimes be difficult but one way to really boost those likes is to offer a reward in the form of a discount code if customers like your Facebook page. This application interfaces with your Magento Store and runs as a Facebook Tab Application to create configurable dynamic dicount codes for Facebook users who like your page.

You must create a Facebook application to use with this system. Users must first connect to the Facebook application which lets us capture user data and store it in our Database, this is used to prevent multiple attempts to obtain discounts. One the application is connected and the page is liked the discount code is issued.

This is really a proof of concept, the way you would actually implement this offer depends on how many current likes your Facebook page has, do you want to offer a coupon code for existing users who have already liked the page? This could get costly if you already have thousands of likes. Think about how you will implement the coupon, perhaps you will offer a discount for a total spend over a certain amount.

Comments for improvement and development are welcome.

### Version
***
	@version		0.2.0
	@since			05 2013
	@author			gaiterjones
	@documentation	blog.gaiterjones.com
	@twitter		twitter.com/gaiterjones
	
### Installation

Copy files to your hosting website. Facebook applications require both http and https
connectivity to the application url. If you do not have an SSL certificate configured 
for your site some Facebook users will not be able to access the application.

Create a new MySQL database and add the following table

	 CREATE  TABLE  `MYDATABASE`.`users` (  `id` int( 6  )  NOT  NULL  AUTO_INCREMENT ,
 	`couponCode` varchar( 64  )  COLLATE utf8_bin NOT  NULL ,
 	`appwallpost` tinyint( 1  )  NOT  NULL DEFAULT  '0',
 	`fbid` varchar( 64  )  COLLATE utf8_bin NOT  NULL ,
 	`name` varchar( 64  )  COLLATE utf8_bin NOT  NULL ,
 	`first_name` varchar( 64  )  COLLATE utf8_bin NOT  NULL ,
 	`last_name` varchar( 64  )  COLLATE utf8_bin NOT  NULL ,
 	`link` varchar( 128  )  COLLATE utf8_bin NOT  NULL ,
 	`image` varchar( 128  )  COLLATE utf8_bin NOT  NULL ,
 	`gender` varchar( 32  )  COLLATE utf8_bin NOT  NULL ,
 	`locale` varchar( 12  )  COLLATE utf8_bin NOT  NULL ,
 	`timeStamp` timestamp NOT  NULL  DEFAULT CURRENT_TIMESTAMP  ON  UPDATE  	CURRENT_TIMESTAMP ,
 	PRIMARY  KEY (  `id`  ) ,
 	UNIQUE  KEY  `fbid` (  `fbid`  ) ,
 	UNIQUE  KEY  `couponCode` (  `couponCode`  )  ) ENGINE  = InnoDB  DEFAULT CHARSET  = utf8 	COLLATE  = utf8_bin

 Create a new Facebook application/page tab application and configure the canvas
 URLs to point to your hosted application files.
 
 Add the application to a Facebook page tab if required.
 
### Configuration

 Configure the App by editing - config/applicationConfig.php
	configure application and coupon options
	create application images and upload to /images folder - see demo images for details

 Configure your App Credentials by editing - config/applicationCredentials.php
 	configure database credentials
	configure facebook application credentials


Test the application.


## License

The MIT License (MIT)
Copyright (c) 2013 Peter Jones

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.