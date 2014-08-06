<?php 

namespace WPF\v1\GUI\Notice;

require_once ( 'wpf_inc.php' );
require_once ( 'wpf_gui_templates.php' );

/*
This class should ideally be used to work with the
administrative side of the WordPress site.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class Admin {

	protected
	$message;

	protected
	$message_type;

	public
	function display() {
		$_template_file = \WPF\v1\GUI\locate_template( 'admin_notice.php' );
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