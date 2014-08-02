<?php 

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! defined( 'WPF_DIR' ) ) {
	define( 'WPF_DIR', __DIR__ );
};

require_once ( 'wpf_admin_notice.php' );

/*
WPF_Compatibility_Validator class. Software compatibility requirements validators base class.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
abstract
class WPF_Compatibility_Validator {

	abstract
	public
	function validate();
	
	public
	function __construct () {}
	
	private
	function __clone() {}

    private
	function __sleep() {}

    private
	function __wakeup() {}
}
?>