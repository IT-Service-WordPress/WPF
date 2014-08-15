<?php 

namespace WPF\v1\Plugin\Component;

require_once ( 'wpf_inc.php' );
require_once ( 'wpf_plugin_component_base.php' );
require_once ( 'wpf_plugin_component_iactivator.php' );

/*
Activator component class.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class Activator
	extends
		Base
	implements
		IActivator
{

	public
	function bind_action_handlers_and_filters() {
		$this->plugin->register_activation_hook( array( &$this, 'activate' ) );
		$this->plugin->register_deactivation_hook( array( &$this, 'deactivate' ) );
	}

	public
	function activate() {
		$result = new \WP_Error();
		foreach ( $this->plugin->get_components( '\WPF\v1\Plugin\Component\IActivable' ) as $component ) {
			$component->activate();
			// !!!! error handling ? !!!!, if WP_DEBUG ?
		};
		\do_action( 'after_activate_' . $this->plugin->get_basename(), $result );
	}

	public
	function deactivate() {
		$result = new \WP_Error();
		foreach ( $this->plugin->get_components( '\WPF\v1\Plugin\Component\IActivable' ) as $component ) {
			$component->deactivate();
			// !!!! error handling ? !!!!, if WP_DEBUG ?
		};
		\do_action( 'after_deactivate_' . $this->plugin->get_basename(), $result );
	}

}
?>