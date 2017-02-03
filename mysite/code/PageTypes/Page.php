<?php
class Page extends SiteTree {

	private static $db = array(
	);

	private static $has_one = array(
	);

}
class Page_Controller extends ContentController {

	/**
	 * An array of actions that can be accessed via a request. Each array element should be an action name, and the
	 * permissions or conditions required to allow the user to access it.
	 *
	 * <code>
	 * array (
	 *     'action', // anyone can access this action
	 *     'action' => true, // same as above
	 *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
	 *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
	 * );
	 * </code>
	 *
	 * @var array
	 */
	private static $allowed_actions = array (
	);

	public function init() {
		parent::init();
		Requirements::css("//fonts.googleapis.com/css?family=Roboto:400,300,500,700' rel='stylesheet");
		Requirements::css("//fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,300italic,400italic,600,600italic,700,700italic");
		Requirements::css("//fonts.googleapis.com/css?family=Mrs+Saint+Delafield");
		Requirements::css("{$this->ThemeDir()}/css/icomoon.css");
		Requirements::css("{$this->ThemeDir()}/css/bootstrap.css");
		Requirements::css("{$this->ThemeDir()}/css/style.css");
		Requirements::css("{$this->ThemeDir()}/css/main.css");
		Requirements::css("{$this->ThemeDir()}/css/color-1.css");
		Requirements::css("{$this->ThemeDir()}/css/animate.css");
		Requirements::css("{$this->ThemeDir()}/css/font-awesome.min.css");
		Requirements::css("{$this->ThemeDir()}/css/responsive.css");
		Requirements::css("{$this->ThemeDir()}/css/transition.css");
		Requirements::css("{$this->ThemeDir()}/css/default.css");

		Requirements::javascript("{$this->ThemeDir()}/js/modernizr.js");
		Requirements::javascript("{$this->ThemeDir()}/js/jquery.js");
		Requirements::javascript("{$this->ThemeDir()}/js/bootstrap.js");
		//Requirements::javascript("{$this->ThemeDir()}/js/gmap3.min.js");
		Requirements::javascript("{$this->ThemeDir()}/js/parallax.js");
		Requirements::javascript("{$this->ThemeDir()}/js/contact-form.js");
		Requirements::javascript("{$this->ThemeDir()}/js/countdown.js");
		Requirements::javascript("{$this->ThemeDir()}/js/nstslider.js");
		Requirements::javascript("{$this->ThemeDir()}/js/owl-carousel.js");
		Requirements::javascript("{$this->ThemeDir()}/js/odometer.js");
		Requirements::javascript("{$this->ThemeDir()}/js/classie.js");
		Requirements::javascript("{$this->ThemeDir()}/js/bootstrap-select.js");
		Requirements::javascript("{$this->ThemeDir()}/js/colorpicker.js");
		Requirements::javascript("{$this->ThemeDir()}/js/appear.js");
		Requirements::javascript("{$this->ThemeDir()}/js/prettyPhoto.js");
		Requirements::javascript("{$this->ThemeDir()}/js/isotope.pkgd.js");
		Requirements::javascript("{$this->ThemeDir()}/js/sticky.js");
		Requirements::javascript("{$this->ThemeDir()}/js/wow-min.js");
		Requirements::javascript("{$this->ThemeDir()}/js/main.js");
		//Requirements::javascript('http://maps.google.com/maps/api/js?sensor=false');
	}

}
