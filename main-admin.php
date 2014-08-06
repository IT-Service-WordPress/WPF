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

new WPF\Plugin\Part\Base (
	new WPF\Compatibility\Validators ( array (
		new WPF\Compatibility\Version\WP( '3.9.9' )
		, new WPF\Compatibility\Version\PHP( '5.6.7' )
	) )
	, new WPF\TextDomain\WPF( WPF\WPF_ADMINTEXTDOMAIN )
);

?>