<?php
/**
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


/**
 * PageMain class.
 * 
 * @extends Page
 */
class PageMain extends Page {


	public function __construct($_variables) {
	
		// load parent
		parent::__construct($_variables);

		// load data for page
		PageMainData::loadConfig();

		PageMainData::menuHTML();
		
		// load html for page
		PageMainHTML::html();
		
		// render page
		$this->createPage();
		
	}


		/**
		 * renderPage function.
		 * 
		 * @access private
		 * @return void
		 */
		private function createPage()
		{
			$_HTMLArray=$this->get('html');
			$_errorMessage=$this->get('errorMessage');
			
			/* render html from html array */
			foreach ($_HTMLArray as $_obj)
			{
				$_usePageHtml=false;
				
				foreach ($_obj as $_key=>$_value)
				{
					
					if ($_key === 'page')
					{				
						$_array=$_value;
						foreach ($_array as $_key=>$_page)
						{
							// render default html
							if ($_page == '*')	{$_usePageHtml=true;}
							
							if (!$this->get('allowstandalone'))
							{
								if ($_page == 'redirector')	{$_usePageHtml=true; }
							}
							
							// check facebook app status
							
							if (!$this->get('facebookAppConnected'))
							{
								if ($_page == 'content-app-connected-false') {$_usePageHtml=true; }
								
							} else {
							
								// check page like status
								if ($this->get('pagelikerequired') && !$this->get('likestatus'))
								{
									// page not liked 
									if ($_page == 'content-like-false') {$_usePageHtml=true; }
									
								} else {
									
									// page liked content
									
									// has coupon already been issued
									if (!$this->get('discountCodeAlreadyIssued'))
									{
										// no
										
										// valid coupon
										if ($this->get('discountCode'))
										{
											// yes
											if ($_page == 'magento-coupon-issued-false') {$_usePageHtml=true; }
											
										} else {
										
											if (empty($_errorMessage)) { if ($_page == 'magento-coupon-error') {$_usePageHtml=true; }}
										}
										
									} else {
										
										// yes
										// code already issued
										if ($_page == 'magento-coupon-issued-true') {$_usePageHtml=true; }
									
									}
								}
							}
							
							if (empty($_errorMessage))
							{
								// no errors
							} else {
								// display error html
								if ($_page == 'error')	{$_usePageHtml=true; }
							}							
							
						}
	
					}
					
					if ($_key === 'html')
					{
						if ($_usePageHtml)
						{
							$_pageHtml=$_pageHtml.$_value;
						}
					}
	
				}
	
			}
			
			$this->set('pageHtml',$_pageHtml);
		}



		/**
		 * __toString function.
		 * 
		 * @access public
		 * @return void
		 */
		public function __toString()
		{
			$html=$this->get('pageHtml');
					return $html;
		}

}