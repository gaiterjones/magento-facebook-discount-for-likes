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

 
class DB{

    protected $con = null;
	protected $__;
	protected $__config;	

	public function __construct() {

		$this->loadConfig();
		$this->connectToDatabase();

	}
	
	 public function __destruct()
	{
		mysql_close($this->con);
	}

	private function loadConfig()
	{
		$this->__config= new config();
	}
	
	 public function connectToDatabase()
	{
		$this->con = mysql_connect($this->__config->get('DBPATH'),$this->__config->get('DBUSER'),$this->__config->get('DBPASS'));
		if (!$this->con) { throw new Exception('<br />Could not connect to database: ' . mysql_error()); }
		mysql_select_db($this->__config->get('DBNAME'), $this->con);
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


