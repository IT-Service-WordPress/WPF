<?php 

namespace WPF\v1\Plugin\Component;

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
class Base
	implements
		IBase
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
	// \WPF\v1\Plugin\IBase&
	$plugin;
	
	public
	function bind(
		\WPF\v1\Plugin\IBase& $plugin
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