<?php 

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! defined( 'WPF_DIR' ) ) {
	define( 'WPF_DIR', __DIR__ );
};

require_once ( 'wpf_templates.php' );

/*
WP_admin_notice class. This class should ideally be used to work with the
administrative side of the WordPress site.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class WPF_admin_notice {

	protected
	$message;

	protected
	$message_type;

	public
	function display() {
		$_template_file = wpf_locate_template( 'admin_notice.php' );
		require( $_template_file );
	}
	
	public
	function __construct (
		$message
		, $type = 'updated' // 'updated', 'error', 'update-nag'
	) {
		$this->message = $message;
		$this->message_type = $type;
		add_action( 'admin_notices', array( &$this, 'display' ) );
	}

	private
	function __clone() {}

    private
	function __sleep() {}

    private
	function __wakeup() {}
}
?>