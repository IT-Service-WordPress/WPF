<?php 

namespace WPF\v1\Plugin\Component;

require_once ( 'wpf_inc.php' );
require_once ( 'wpf_plugin_component_ibase.php' );

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
		$this->__after_construct();
	}
	
	protected
	function __after_construct() {
	}

	private
	function __clone() {}

	private
	function __sleep() {
		return array();
	}

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

	public
	function get_plugin() {
		return $this->plugin;
	}

	protected
	function check_bind() {
		if ( is_null( $this->plugin ) ) {
			// !!! throw error !!!
		};
	}

}
?>