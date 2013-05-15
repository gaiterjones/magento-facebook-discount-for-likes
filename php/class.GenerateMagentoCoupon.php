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

class GenerateMagentoCoupon // creates a Magento discount coupon
{

	protected $__config;
	protected $__;
	
	public function __construct($_discountCode) {
		
			$this->loadConfig();
			$this->loadMagento();
			$this->generateMagentoCoupon($_discountCode);
 
	}

	private function loadConfig()
	{
		$this->__config= new config();
	}

	private function loadMagento()
	{
		require_once $this->__config->get('PATH_TO_MAGENTO_INSTALLATION'). 'app/Mage.php';
		
		Mage::app();
	}
	
	
	private function generateMagentoCoupon($_discountCode)
    {
        $model = Mage::getModel('salesrule/rule');

        $model->setName($_discountCode);
        $model->setDescription($this->__config->get('couponDescription'));
        $model->setFromDate(date('Y-m-d'));
		
		$_couponValidty=$this->__config->get('couponValidty');
		
		if (!empty($_couponValidty)) { $model->setToDate(date('Y-m-d',strtotime('+'. $_couponValidty. ' days'))); }
		
		// required for Magento 1.4+?
		$model->setCouponType(2);
		
        $model->setCouponCode($_discountCode);
        $model->setUsesPerCoupon(1);
        $model->setUsesPerCustomer(1);
        $model->setCustomerGroupIds($this->__config->get('couponCustomerGroups'));
        $model->setIsActive(1);
        $model->setConditionsSerialized('a:6:{s:4:\"type\";s:32:\"salesrule/rule_condition_combine\";s:9:\"attribute\";N;s:8:\"operator\";N;s:5:\"value\";s:1:\"1\";s:18:\"is_value_processed\";N;s:10:\"aggregator\";s:3:\"all\";}');
        $model->setActionsSerialized('a:6:{s:4:\"type\";s:40:\"salesrule/rule_condition_product_combine\";s:9:\"attribute\";N;s:8:\"operator\";N;s:5:\"value\";s:1:\"1\";s:18:\"is_value_processed\";N;s:10:\"aggregator\";s:3:\"all\";}');
        $model->setStopRulesProcessing(0);
        $model->setIsAdvanced(1);
        $model->setProductIds('');
        $model->setSortOrder(1);
        $model->setSimpleAction('cart_fixed');
        $model->setDiscountAmount(5);
        $model->setDiscountStep(0);
        $model->setSimpleFreeShipping(0);
        $model->setTimesUsed(0);
        $model->setIsRss(0);
        $model->setWebsiteIds('1');

        $model->save();
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