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

require_once (  'wpf' . DIRECTORY_SEPARATOR . 'wpf_plugin.php' );
require_once (  'wpf' . DIRECTORY_SEPARATOR . 'wpf_plugin_part_loader.php' );
// require_once (  'wpf' . DIRECTORY_SEPARATOR . 'wpf_textdomain_plugin.php' );

use \WPF\v1 as WPF;

new WPF\WPF_Plugin (
	__FILE__
//	, new WPF\WPF_TextDomain_Plugin( 'wordpress-plugin-template' )
	
	, new WPF\WPF_Plugin_Part_Loader( 'main-admin.php' )
);

?>