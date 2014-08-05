<?php 

namespace WPF\v1;

require_once ( 'wpf_inc.php' );
require_once ( 'iwpf_plugin_component.php' );

/*
WPF_Plugin_Component class. Just metadata.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
abstract
class WPF_Plugin_Component
	implements
		IWPF_Plugin_Component
{

	public
	function __construct( 
	) {
	}

	private
	function __clone() {}

    private
	function __sleep() {}

    private
	function __wakeup() {}

	protected
	// IWPF_Plugin&
	$plugin;
	
	public
	function bind(
		IWPF_Plugin& $plugin
	) {
		$this->plugin = $plugin;
	}
	
	protected
	function check_bind() {
		if ( is_null( $this->plugin ) ) {
			// !!! throw error !!!
		};
	}

}
?>