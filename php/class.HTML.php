<?php
/**
 *  A class to render some html
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

class HTML{
	
	// HTML class variables array $this->__variable
	protected $__;
	protected $__config;
	
	public function __construct($_variables) {

		$this->__config= new config();
		
		$_constants=array(
			"pageTitle"  => $this->__config->get('pageTitle'),
		  	"pageDescription" => $this->__config->get('pageDescription'),
		  	"fbURL" => $this->__config->get('fbURL'),
		  	"appURL" => $this->__config->get('appURL'),
		  	"allowStandAlone" => $this->__config->get('allowStandAlone'),
		  	"errorMessage" => '',
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
		
		if(is_array($_constants)) {
			foreach ($_constants as $key => $value)
			{
				$this->set($key,$value);
			}
		}		
		
		foreach ($_variables as $key => $value)
		{
			$this->set($key,$value);
		}

	}

		public function __toString()
		  {
		    $html=null;
			$html=$this->header(). $this->content(). $this->footer();
			return $html;
		  }

		public function set($key,$value)
		  {
		    $this->__[$key] = $value;
		  }
		
	  	public function get($variable)
		  {
		    return $this->__[$variable];
		  }
		

		public function header(){
$html=null;
$html=$html.'
<html>
<head>
<title>'. $this->get('pageTitle'). '</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta property="og:site_name" content="'. $this->get('pageTitle'). '"/> 
<meta property="og:type" content="website"/> 
<meta property="og:url" content="'. $this->get('appURL'). '"/> 
<meta property="og:description" content="'. $this->get('pageDescription'). '"/> 
<meta property="og:title" content="'. $this->get('pageTitle'). '"/> 
<meta property="og:image" content="'. $this->get('appURL'). 'images/blah.png"/> 
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="js/fancybox/jquery.fancybox.js?v=2.0.6"></script>
<link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox.css?v=2.0.6" media="screen" />
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {
$(\'.fancybox\').fancybox();
';

if (!$this->get('allowStandAlone'))
{
$html = $html. '
  function NotInFacebookFrame() {
    return top === self;
  }
  function ReferrerIsFacebookApp() {
    if(document.referrer) {
      return document.referrer.indexOf("apps.facebook.com") != -1;
    }
    return false;
  }
  if (NotInFacebookFrame() || ReferrerIsFacebookApp()) {
    top.location.replace("'. $this->get('fbURL'). '");
  }';
}

$html=$html.'
});
//]]>
</script>
</head>
<body>
<!-- START Wrapper -->
<div id="wrapper">
	<!-- Load facebook SDK -->
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId='. $this->get('fbAppID'). '";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, \'script\', \'facebook-jssdk\'));</script>
';
		
return $html;
	
}

	public function content(){

$img=null;
$html=null;
$couponDiv=null;
$contentDiv=null;

$html=$html.'
	<!-- START Content 1 -->
	<div id="contentContainer1">
	';

if ($this->get('isFacebookAppConnected') && !$this->get('isFan'))
{
$contentDiv='
	<img class="discountVoucher" src="images/'. $this->get('couponBanner1'). '">
	<br />
	<div class="fbgreybox" style="width: 500px;">
		<div class="fbbody textNorm center"><a class="fancybox fancybox.iframe" href="terms.html">Terms &amp; Conditions</a> | <a class="fancybox fancybox.iframe" href="privacy.html">Privacy Policy</a> | <a href="'. $this->get('storeURL'). '" target="_blank">Visit '. $this->get('storeName'). '</a></div>
	</div>
	<br />	
	';
}

if (!$this->get('isFacebookAppConnected'))
{
$contentDiv='
	<div class="fberrorbox" style="width: 500px;">
	Please login...
	<script> top.location.href=\'' . $this->get('facebookApploginUrl'). '\'</script>
	</div>
	<br />
	';
}
	
if ($this->get('isFacebookAppConnected') && $this->get('isFan'))
{
$img='
	<img class="discountVoucher" src="images/'. $this->get('couponBanner2'). '">
	';
$contentDiv='
	<br />
	<div class="fbgreybox" style="width: 500px;">
		<div class="fbbody textNorm center"><a class="fancybox fancybox.iframe" href="terms.html">Terms &amp; Conditions</a> | <a class="fancybox fancybox.iframe" href="privacy.html">Privacy Policy</a> | <a href="'. $this->get('storeURL'). '" target="_blank">Visit '. $this->get('storeName'). '</a></div>
	</div>
	<br />
	';
	
	// coupon HTML
	$_magentoCouponCode=$this->get('magentoDiscountCode');
	
	if (!empty($_magentoCouponCode))
	{
$couponDiv='
	<div class="couponCode">
		<strong>'. $_magentoCouponCode. '</strong>
	</div>
	';		
	} else {
		if (substr($this->get('errorMessage'),0,42)==='A discount code has already been issued to')
		{
	$img='
		<a href="'. $this->get('storeURL'). '" alt="Visit '. $this->get('storeName'). '" target="_blank"><img class="discountVoucher" src="images/'. $this->get('couponBanner3'). '"></a>
		';	
		} else {
	$img='		
		<img class="discountVoucher" src="images/'. $this->get('couponErrorBanner'). '">
		';
		}
		
$couponDiv='
	<div class="fberrorbox center" style="width: 500px;">
	'. $this->get('errorMessage'). '
	</div>
	<br />
	';		
	}
}

$html=$html.$img.$contentDiv.$couponDiv.'
	</div>
	<!-- END Content 1 -->
';

return $html;
}

	public function footer()
{
$html=null;
$html=$html.'
	<!-- START Footer -->
			<div id="footer">';

				if ($this->__['demo'])
				{
					$html=$html.'
						<div class="fbcontentdivider"></div>				
						<div class="fbbody fbinfobox" style="width: 500px;">'.
							$this->__['demoText'].
						'</div>
						<div class="fbcontentdivider"></div>
					';
				}
				
				$html = $html. '<br />';
				
				if ($this->get('showComments'))
				{
				$html = $html. '			
				<!-- facebook comments plugin -->
				<div class="fb-comments" data-href="'. $this->get('appURL'). '" data-num-posts="15" data-width="500" data-colorscheme="light"></div>

				';
				}
			$html = $html. '			
			</div>
	<!-- END Footer -->
<!-- END Wrapper-->
</div>
</body>
</html>
';


return $html;
}


}
?>