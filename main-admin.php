<?php
/*
WordPress-plugin-template plugin admin part.
*/

require_once (  'wpf' . DIRECTORY_SEPARATOR . 'wpf_plugin_part_base.php' );
require_once (  'wpf' . DIRECTORY_SEPARATOR . 'wpf_compatibility_validators.php' );
require_once (  'wpf' . DIRECTORY_SEPARATOR . 'wpf_compatibility_version_wp.php' );
require_once (  'wpf' . DIRECTORY_SEPARATOR . 'wpf_compatibility_version_php.php' );
require_once (  'wpf' . DIRECTORY_SEPARATOR . 'wpf_textdomain_plugin.php' );
require_once (  'wpf' . DIRECTORY_SEPARATOR . 'wpf_textdomain_wpf.php' );
require_once (  'wpf' . DIRECTORY_SEPARATOR . 'wpf_plugin_component_installer.php' );

use \WPF\v1 as WPF;

new WPF\Plugin\Part\Base (
	new WPF\Compatibility\Validators (
		new WPF\Compatibility\Version\WP( '3.9.0' )
		, new WPF\Compatibility\Version\PHP( '5.5.0' )
	)
	, new WPF\TextDomain\WPF( WPF\WPF_ADMINTEXTDOMAIN )
	, new WPF\Plugin\Component\Installer()
);

?>