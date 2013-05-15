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

class PageMainHTML {


function html()
{
$_HTML[] = array
	(
    'page' => array
    	(
	    	'*',
	    ),
    'html' => '
<html>
<head>
<title>'. $this->get('pageTitle'). '</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta property="og:site_name" content="'. $this->get('pageTitle'). '"/> 
<meta property="og:type" content="website"/> 
<meta property="og:url" content="'. $this->get('appURL'). '"/> 
<meta property="og:description" content="'. $this->get('pageDescription'). '"/> 
<meta property="og:title" content="'. $this->get('pageTitle'). '"/> 
<meta property="og:image" content="'. $this->get('appURL'). 'images/logo.png"/> 
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="js/fancybox/jquery.fancybox.js?v=2.0.6"></script>
<link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox.css?v=2.0.6" media="screen" />

	<script type="text/javascript">
	$(document).ready(function() {
	$(\'.fancybox\').fancybox();
	});
	</script>
	
</head>
<body>
<!-- START Wrapper -->
<div id="wrapper">
	<!-- Load facebook SDK -->
	<div id="fb-root"></div>
	<script src="https://connect.facebook.net/en_US/all.js"></script>
	<script>
	FB.init({
	appId  : \''. $this->__config->get('fbAppID') .'\',
	status : true,
	cookie : true,
	xfbml : true
	});

	window.fbAsyncInit = function() {
	FB.Canvas.setAutoGrow();
	}
	(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId='. $this->__config->get('fbAppID') .'";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, \'script\', \'facebook-jssdk\'));
	</script>
	
	<!-- START CONTENT -->
	<div id="contentContainer1">	
'
);

// redirect to facebook tab when standalone disabled
$_HTML[] = array
	(
    'page' => array
    	(
	    	'redirector',
	    ),
    'html' => '
<script>	
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
  }
</script> 
'
);


// mainpage content
// app not connected
// generate login html
$_HTML[] = array
	(
    'page' => array
    	(
	    	'content-app-connected-false',
	    ),
	'html' => '
	<div class="fberrorbox" style="width: 500px;">
	Please login...
	<script> top.location.href=\'' . $this->get('facebookApploginUrl'). '\'</script>
	</div>
	<br />

	'
	);

// mainpage content
// app connected
// page not liked
$_HTML[] = array
	(
    'page' => array
    	(
			'content-like-false',
	    ),
	'html' => '
	<img class="discountVoucher" src="images/'. $this->get('couponBanner1'). '">
	'. $this->get('menuhtml')
	);

// mainpage content
// app connected
// page liked
// coupon no issued
$_HTML[] = array
	(
    'page' => array
    	(
			'magento-coupon-issued-false',
	    ),
    'html' => '
	<img class="discountVoucher" src="images/'. $this->get('couponBanner2'). '">	
	<div class="couponCode">
		<strong>'. $this->get('discountCode'). '</strong>
	</div>	
'. $this->get('menuhtml')			
    );
	
// mainpage content
// app connected
// page liked
// coupon already issued
$_HTML[] = array
	(
    'page' => array
    	(
			'magento-coupon-issued-true',
	    ),
    'html' => '
	<a href="'. $this->get('storeURL'). '" alt="Visit '. $this->get('storeName'). '" target="_blank"><img class="discountVoucher" src="images/'. $this->get('couponBanner3'). '"></a>
'. $this->get('menuhtml'). '
	<div class="fberrorbox center" style="width: 500px;">
	'. $this->get('discountCodeMessage'). '
	</div>'
    );	
	
	
// mainpage content
// app connected
// page liked
// coupon error
$_HTML[] = array
	(
    'page' => array
    	(
			'magento-coupon-error',
	    ),
    'html' => '
	<img class="discountVoucher" src="images/'. $this->get('couponErrorBanner'). '">
'. $this->get('menuhtml')			
    );		

// mainpage content
// app connected
// page liked
// page error
$_HTML[] = array
	(
    'page' => array
    	(
			'error',
	    ),
    'html' => '
	<img class="discountVoucher" src="images/'. $this->get('couponErrorBanner'). '">
'. $this->get('menuhtml'). '
	<div class="fberrorbox center" style="width: 500px;">
	'. $this->get('errorMessage'). '
	</div>'
    );		

	
// footer
$_HTML[] = array
	(
    'page' => array
    	(
			'*',
	    ),
	'html' => '
	</div>
	<!-- END CONTENT -->	
	
	<!-- START Footer -->
			<div id="footer">'. 
				($this->__['demo'] ?
						'<div class="fbcontentdivider"></div>				
						<div class="fbbody fbinfobox" style="width: 500px;">'.
							$this->__['demoText'].
						'</div>
						<div class="fbcontentdivider"></div>
					' : '').
				'<br />'. 
				
				($this->get('showComments') ? 
				'
				<!-- facebook comments plugin -->
				<div class="fb-comments" data-href="'. $this->get('appURL'). '" data-num-posts="15" data-width="500" data-colorscheme="light"></div>

				' : ''). '			
			</div>
	<!-- END Footer -->
<!-- END Wrapper-->
</div>
</body>
</html>
'
);





$this->set('html',$_HTML);
	
}


}