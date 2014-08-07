<?php
/* 
Plugin Name:		WordPress-plugin-template
Plugin URI:			http://sergey-s-betke.blogs.csm.nov.ru/category/web/wordpress/
Description:		Automatically send HTTP 1.1 headers "Cache-control", "Pragma" and "Expires".
Version:			0.1.0
Author:				Sergey S. Betke
Author URI:			http://sergey-s-betke.blogs.csm.nov.ru/about
Text Domain:		wordpress-plugin-template
Domain Path:		/languages/
GitHub Plugin URI: 	https://github.com/sergey-s-betke/WordPress-plugin-template
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
require_once (  'wpf' . DIRECTORY_SEPARATOR . 'wpf_inc.php' );
require_once (  'wpf' . DIRECTORY_SEPARATOR . 'wpf_plugin_base.php' );
require_once (  'wpf' . DIRECTORY_SEPARATOR . 'wpf_option_base.php' );
require_once (  'wpf' . DIRECTORY_SEPARATOR . 'wpf_plugin_part_load_admin.php' );
// require_once (  'wpf' . DIRECTORY_SEPARATOR . 'wpf_textdomain_plugin.php' );

use \WPF\v1 as WPF;

new WPF\Plugin\Base (
	__FILE__
	, new WPF\Option\Base()
//	, new WPF\TextDomain\Plugin( 'wordpress-plugin-template' )
	
	, new WPF\Plugin\Part\Load\Admin()
);

?>