<?php 

namespace WPF\v1\Plugin\Component;

require_once ( 'wpf_inc.php' );
require_once ( 'wpf_plugin_component_base.php' );
require_once ( 'wpf_plugin_component_dependable.php' );
require_once ( 'wpf_plugin_component_idynamic.php' );
require_once ( 'wpf_plugin_component_idynamiccontroller.php' );

/*
Dynamics components base class.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
abstract
class Dynamic
	extends
		Dependable
	implements
		IDynamic
{

	public
	function __construct() {
		parent::__construct();
	}

	public
	function __sleep() {
		return array();
	}

	protected
	// \WPF\v1\Plugin\Component\IDynamicController
	$dynamic_components_controller;

	public
	function bind(
		\WPF\v1\Plugin\IBase& $plugin
	) {
		parent::bind( $plugin );
		$this->dynamic_components_controller = $this->plugin->get_components( '\WPF\v1\Plugin\Component\IDynamicController' )[ 0 ];
		$this->dynamic_components_controller->add_components( $this );
	}

	public
	function save() {
		$this->dynamic_components_controller->save_components();
	}

	public
	function unbind() {
		$this->dynamic_components_controller->remove_components( $this );
	}

	public
	function get_dependencies() {
		return array( '\WPF\v1\Plugin\Component\IDynamicController' );
	}

}
?>