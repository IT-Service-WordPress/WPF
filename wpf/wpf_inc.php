<?php 
/*
Wordpress Plugin framework common header file.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! defined( 'WPF_DIR' ) ) {
	define( 'WPF_DIR', __DIR__ );
	define( 'WPF_TEXTDOMAIN', 'wpf' );
	define( 'WPF_ADMINTEXTDOMAIN', 'wpf-admin' );
	define( 'WPF_TEXTDOMAIN_PATH', plugin_basename( WPF_DIR ) . DIRECTORY_SEPARATOR . 'languages' . DIRECTORY_SEPARATOR );
};

?>