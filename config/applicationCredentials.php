<?php
/**
 *  
 *  Copyright (C) 2013 paj@gaiterjones.com
 *
 * 	Enter your application credentials here
 *
 */

 class applicationCredentials
 {
 
	 public function load()
	 {
		 // ENTER YOUR MYSQL CREDENTIALS
		 $_dbUser='YOUR-DB-USERNAME';
		 $_dbPassword='YOUR-DB-PASSWORD';
		 $_dbPath='localhost';
		 $_dbName='facebookappmagento';

		 // ENTER YOUR FACEBOOK APP CREDENTIALS
		 $_fbAppID='YOUR-FACEBOOK-APP-ID';
		 $_fbAppSecret='YOUR-FACEBOOK-APP-SECRET';		 
		 
		 // save credentials
		 $this->set('DBPATH',$_dbPath);
		 $this->set('DBNAME',$_dbName);
		 $this->set('DBUSER',$_dbUser);
		 $this->set('DBPASS',$_dbPassword);
		 $this->set('fbAppID',$_fbAppID);
		 $this->set('fbAppSecret',$_fbAppSecret);
 
	 }
	 
 }
 
?>