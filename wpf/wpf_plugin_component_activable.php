<?php 

namespace WPF\v1\Plugin\Component;

require_once ( 'wpf_inc.php' );
require_once ( 'wpf_plugin_component_base.php' );
require_once ( 'wpf_plugin_component_iactivable.php' );

/*
Activable components base class.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
abstract
class Activable
	extends
		Base
	implements
		IActivable
{

	public
	function bind_action_handlers_and_filters() {
		if ( \WP_DEBUG ) {
			if ( \is_admin() /* && \current_user_can( 'install_plugins' ) */ ) {
				$this->plugin->add_action( 'admin_init', array( $this, 'check_dependencies' ) ); 
			};
		};
	}

	public
	function check_dependencies() {
		if ( ! $this->plugin->has_component( '\WPF\v1\Plugin\Component\IActivator' ) ) {
			require_once( 'wpf_gui_notice_admin.php' );
			new \WPF\v1\GUI\Notice\Admin(
				sprintf(
					__( 'Plugin "%1$s" coding error: component <code>%2$s</code> requires <code>%3$s</code> component in plugin.', \WPF\v1\WPF_ADMINTEXTDOMAIN )
					, $this->plugin->get_title()
					, \get_class( $this )
					, 'IActivator'
				)
				, 'error'
			);
		};
	}

}
?>