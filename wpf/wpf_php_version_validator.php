<?php 

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! defined( 'WPF_DIR' ) ) {
	define( 'WPF_DIR', __DIR__ );
};

require_once ( 'wpf_version_validator.php' );

/*
WPF_Version_Validator class.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class WPF_PHP_Version_Validator extends WPF_Version_Validator {

	public
	function validate() {
		if (
			version_compare( phpversion(), $this->required_version, "<" )
		) {
			return new WP_Error(
				'error'
				, sprintf(
					__( 'PHP %1$s or newer is required. Current version - %2$s. <a href="%3$s">Please update!</a>', 'wpf' )
					, $this->required_version
					, phpversion()
					, 'http://ru2.php.net/downloads.php'
				)
			);
		} else {
			return true;
		};
	}

}
?>