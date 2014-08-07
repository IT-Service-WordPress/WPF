<?php 

namespace WPF\v1\Plugin\Component;

require_once ( 'wpf_inc.php' );
require_once ( 'wpf_plugin_component_activator.php' );
require_once ( 'wpf_plugin_component_iinstaller.php' );

/*
Component installer class.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class Installer
	extends
		Activator
	implements
		IInstaller
{

	public
	function bind_action_handlers_and_filters() {
		parent::bind_action_handlers_and_filters();
		// $this->plugin->register_activation_hook( array( $this, 'activate' ) ); 
		// $this->plugin->register_deactivation_hook( array( $this, 'deactivate' ) ); 
	}

	public
	function install() {
		foreach ( $this->plugin->get_components( '\WPF\v1\Plugin\Component\IInstallable' ) as $component ) {
			$component->install();
			// !!!! error handling ? !!!!, if WP_DEBUG ?
		};
	}

	public
	function uninstall() {
		foreach ( $this->plugin->get_components( '\WPF\v1\Plugin\Component\IInstallable' ) as $component ) {
			$component->uninstall();
			// !!!! error handling ? !!!!, if WP_DEBUG ?
		};
	}

}
?>