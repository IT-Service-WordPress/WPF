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
require_once (  'wpf' . DIRECTORY_SEPARATOR . 'wpf_compatibility_validators.php' );
require_once (  'wpf' . DIRECTORY_SEPARATOR . 'wpf_wp_version_validator.php' );
require_once (  'wpf' . DIRECTORY_SEPARATOR . 'wpf_php_version_validator.php' );
require_once (  'wpf' . DIRECTORY_SEPARATOR . 'wpf_textdomain_plugin.php' );
require_once (  'wpf' . DIRECTORY_SEPARATOR . 'wpf_admin.php' );

new WPF_Plugin (
	__FILE__
	, new WPF_Compatibility_Validators ( array (
		new WPF_WP_Version_Validator( '3.9.9' )
		, new WPF_PHP_Version_Validator( '5.6.7' )
	) )
	, new WPF_TextDomain_Plugin ( 'wordpress-plugin-template' )
	, $WPF_TextDomain_Admin
);

?>