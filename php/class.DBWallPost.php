<?php
/**
 *  DB Class file for Facebook/Magento
 *  Social Media marketing application that
 *  awards customers who like a Facebook page
 *  with a configurable Magento discount coupon.
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

 

class DBWallPost extends DB 
{
	
	
	 public function wallPostStatus($action,$id)
	 {	
		if ($action==='get')
		// get wallpost status from db
		{
			
			$result= mysql_query("SELECT appwallpost, first_name, fbid FROM users WHERE id = ". $id);
			
			if (!$result) throw new Exception("Query failed: " . mysql_error());

			$row = mysql_fetch_row($result);
			
			if (!$row[0])
			{
				// wall post set
				$this->set('wallPostStatus', true);

			} else {
				$this->set('wallPostStatus', false);
			}
			
		}
		
		if ($action==='set')
		// set wallpost status
		{
			$result= mysql_query("UPDATE users SET appwallpost = 1 WHERE id = ". $id);
			
			if ($result)
			{
				$this->set('wallPostUpdated', true);
				return;
				
			} else {
			
				throw new Exception("Query failed: " . mysql_error());
			}
		}

	}
}
