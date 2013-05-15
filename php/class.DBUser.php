<?php
/**
 *  DB Class file for to add a database user
 *  using data from Facebook app
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

 

class DBUser extends DB 
{
	  
	 public function __construct($user_profile,$user_image,$couponCode) {

		parent::__construct();
		
		$this->createCustomerRecord($user_profile,$user_image,$couponCode);

	}
	  
	  private function createCustomerRecord($user_profile,$user_image,$couponCode)
	 {	
		
		$_query="INSERT INTO users (fbid, name, first_name, last_name, email, link, gender, locale, image, couponCode) VALUES
		('". $user_profile['id']. "','". $user_profile['name']. "','". $user_profile['first_name']. "','". $user_profile['last_name']. "','". $user_profile['email']. "','". $user_profile['link']. "','". $user_profile['gender']. "','". $user_profile['locale']. "','". $user_image['picture']."','". $couponCode ."')";
		
		
		$result=mysql_query($_query);
		
		// handle duplicate entry
		if (mysql_errno() == 1062) {
		
			// duplicated row
				$this->set('newUser', false);
				$this->set('id', mysql_insert_id());
				return;

		}
		
		if (!$result) throw new Exception("Query failed: " . mysql_error());
		
		// new row
		$this->set('newUser', true);
		$this->set('id', mysql_insert_id());
		return;
	}
}
