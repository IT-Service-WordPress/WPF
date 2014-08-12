<?php 

namespace WPF\v1\Plugin\Component;

require_once ( 'wpf_inc.php' );
require_once ( 'wpf_plugin_component_base.php' );
require_once ( 'wpf_plugin_component_idefferedactionscontroller.php' );

/*
Deffered actions controller component class.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class DefferedActionsController
	extends
		Base
	implements
		IDefferedActionsController
{

	public
	function bind_action_handlers_and_filters() {
		\add_action( 'admin_init', array( &$this, 'run_deffered_actions' ) );
	}

	public
	function run_deffered_actions(
		$actions = null // action name or empty for all actions
	) {
		if ( !$actions ) {
			$actions = $this->plugin->get_deffered_actions();
		};
		foreach ( (array) $actions as $action ) {
			\do_action(
				'after_' . $action . '_' . $this->plugin->get_basename()
				, $this->plugin->get_and_reset_deffered_action( $action )
			);
		};
	}

}
?>