Installation instructions

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
 `timeStamp` timestamp NOT  NULL  DEFAULT CURRENT_TIMESTAMP  ON  UPDATE  CURRENT_TIMESTAMP ,
 PRIMARY  KEY (  `id`  ) ,
 UNIQUE  KEY  `fbid` (  `fbid`  ) ,
 UNIQUE  KEY  `couponCode` (  `couponCode`  )  ) ENGINE  = InnoDB  DEFAULT CHARSET  = utf8 COLLATE  = utf8_bin
 
 Create a new Facebook application/page tab application and configure the canvas
 URLs to point to your hosted application files.
 
 Add the application to a Facebook page tab if required.
 
 Configure config.php within the application
	configure database credentials
	configure facebook application credentials
	configure application and coupon options
	create application images and upload to /images folder
	
Test the application.


paj@gaiterjones.com