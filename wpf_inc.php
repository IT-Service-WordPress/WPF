<?php 
/*
Wordpress Plugin framework common header file.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/

namespace WPF\v1;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! defined( 'WPFINCv1' ) ) {
	// WPF instance isn't already loaded

	if ( $wpf_basedir = \get_option( 'wpf_basepath_v1' ) ) {
		// "plugin" WPF-v${version} installed
		require_once( 'wpf_loader.php' );
		$current_wpf_root_dir = Loader::get_root_dir();
		if ( $current_wpf_root_dir == $wpf_basedir ) {
			// it's shared WPF instance
			define( 'WPFINCv1', __DIR__ );
			Loader::set_root_dir();
			require_once( 'wpf_inc2.php' );
		} else {
			// it isn't shared WPF instance, load shared instance
			require_once( Loader::get_file( 'wpf_inc.php', $wpf_basedir ) );
		};
	} else {
		// "plugin" WPF-v${version} doesn't installed
		define( 'WPFINCv1', __DIR__ );
		require_once( 'wpf_loader.php' );
		Loader::set_root_dir();
		require_once( 'wpf_inc2.php' );
	};
};

?>