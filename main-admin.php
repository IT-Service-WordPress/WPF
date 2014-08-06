<?php
/*
WordPress-plugin-template plugin admin part.
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

require_once (  'wpf' . DIRECTORY_SEPARATOR . 'wpf_plugin_part.php' );
require_once (  'wpf' . DIRECTORY_SEPARATOR . 'wpf_compatibility_validators.php' );
require_once (  'wpf' . DIRECTORY_SEPARATOR . 'wpf_wp_version_validator.php' );
require_once (  'wpf' . DIRECTORY_SEPARATOR . 'wpf_php_version_validator.php' );
require_once (  'wpf' . DIRECTORY_SEPARATOR . 'wpf_textdomain_plugin.php' );
require_once (  'wpf' . DIRECTORY_SEPARATOR . 'wpf_textdomain_wpf.php' );

use \WPF\v1 as WPF;

new WPF\WPF_Plugin_Part (
	new WPF\WPF_Compatibility_Validators ( array (
		new WPF\WPF_WP_Version_Validator( '3.9.9' )
		, new WPF\WPF_PHP_Version_Validator( '5.6.7' )
	) )
	, new WPF\WPF_TextDomain_WPF( WPF\WPF_ADMINTEXTDOMAIN )
);

?>