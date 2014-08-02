<?php 

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/*
WP_admin_notice class. This class should ideally be used to work with the
administrative side of the WordPress site.

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class WP_admin_notice {

	protected
	$message;

	protected
	$message_type;

	public
	function show_message() {
		echo
			'<div class="'. $this->message_type . '">'
			. $this->message
			. '</div>'
		;
	}
	
	public
	function __construct (
		$message
		, $type = 'updated' // 'updated', 'error', 'update-nag'
	) {
		$this->message = $message;
		$this->message_type = $type;
		add_action( 'admin_notices', array( &$this, 'show_message' ) );
	}

	private
	function __clone() {}

    private
	function __sleep() {}

    private
	function __wakeup() {}
}
?>