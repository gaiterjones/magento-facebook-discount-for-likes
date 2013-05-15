<?php
/**
 *  A class to generate a Magento discount code and coupon
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

class GenerateDiscountCode
{

	protected $__;

	function __construct($_discountCodePrefix) {

		$this->discountCode($_discountCodePrefix);

	}
	

	private function discountCode($_discountCodePrefix) {
	
		$chars = "ABCDEFGHIJKLMNPQRSTUVWXYZ123456789";
		srand((double)microtime()*1000000);
		$i = 0;
		$code = '' ;
		while ($i <= 7)
		{
			$num = rand() % 33;
			$tmp = substr($chars, $num, 1);
			$code = $code . $tmp;
			$i++;
		}

		$this->set('discountCode',(trim($_discountCodePrefix. $code)));
		
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
?>