<?php
/**
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

class PageMainData {

		// load data for main page
		//
		function loadConfig()
		{
			// define class variables
			$_array=array(
				"pageTitle"  => $this->__config->get('pageTitle'),
				"pageDescription" => $this->__config->get('pageDescription'),
				"fbURL" => $this->__config->get('fbURL'),
				"appURL" => $this->__config->get('appURL'),
				"allowstandalone" => $this->__config->get('allowStandAlone'),
				"pagelikerequired" => $this->__config->get('pagelikerequired'),
				"couponBanner1" => $this->__config->get('couponBanner1'),
				"couponBanner2" => $this->__config->get('couponBanner2'),
				"couponBanner3" => $this->__config->get('couponBanner3'),
				"couponErrorBanner" => $this->__config->get('couponErrorBanner'),
				"storeURL" => $this->__config->get('storeURL'),
				"storeName" => $this->__config->get('storeName'),
				"fbAppID" => $this->__config->get('fbAppID'),
				"demo" => $this->__config->get('demo'),
				"demoText" => $this->__config->get('demoText'),
				"showComments" => $this->__config->get('showComments')
			);
			
			// load class variables
			$this->loadClassVariables($_array);
		}

		// load data for main page
		//
		function menuHTML()
		{		

			$_html='
			<br />
			<div class="fbgreybox" style="width: 500px;">
				<div class="fbbody textNorm center"><a class="fancybox fancybox.iframe" href="terms.html">Terms &amp; Conditions</a> | <a class="fancybox fancybox.iframe" href="privacy.html">Privacy Policy</a> | <a href="'. $this->get('storeURL'). '" target="_blank">Visit '. $this->get('storeName'). '</a></div>
			</div>
			<br />';
			
			$this->set('menuhtml',$_html);
		}
}