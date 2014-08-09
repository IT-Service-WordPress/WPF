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
		$this->plugin->add_action(
			'uninstall_' . $this->plugin->get_basename()
			, array( $this, 'uninstall' )
		);
	}
	
	protected
	function get_installed_version_property_name() {
		return $this->plugin->get_namespace() . '-' . 'installed_version';
	}
	
	protected
	function get_installed_version() {
		return \get_option( $this->get_installed_version_property_name() );
		// !!! network wide multisite ? !!!
	}
	
	protected
	function register_installed_version(
		$version
	) {
		if ( ! $this->get_installed_version() ) {
			\add_option(
				$this->get_installed_version_property_name()
				, $version
				, ''
				, 'no'
			);
			// !!! network wide multisite ? !!!
		} else {
			\update_option(
				$this->get_installed_version_property_name()
				, $version
			);
			// !!! network wide multisite ? !!!
		};
	}

	protected
	function deregister_installed_version() {
		\delete_option(
			$this->get_installed_version_property_name()
		);
		// !!! network wide multisite ? !!!
	}

	public
	function activate() {
		$prev_version = $this->get_installed_version();
		if ( ! $prev_version ) {
			$this->install();
		} elseif ( version_compare( 
			$prev_version
			, $this->plugin->get_version()
			, '<' 
		) ) {
			$this->update( $prev_version );
		};
		parent::activate();
	}

	public
	function deactivate() {
		parent::deactivate();
	}
	
	public
	function install() {
		foreach ( $this->plugin->get_components( '\WPF\v1\Plugin\Component\IInstallable' ) as $component ) {
			$component->install();
			// !!!! error handling ? !!!!, if WP_DEBUG ?
		};
		$this->register_installed_version( $this->plugin->get_version() );
		$this->plugin->register_uninstall_hook(
			array( __CLASS__, '_uninstall' )
		); 
	}

	public
	static
	function _uninstall() {
		// stub, realy action - in `uninstall_<plugin_file>` action.
	}
	
	public
	function uninstall() {
		foreach ( $this->plugin->get_components( '\WPF\v1\Plugin\Component\IInstallable' ) as $component ) {
			$component->uninstall();
			// !!!! error handling ? !!!!, if WP_DEBUG ?
		};
		$this->deregister_installed_version();
	}

	public
	function update(
		$from_version
	) {
		foreach ( $this->plugin->get_components( '\WPF\v1\Plugin\Component\IUpdatable' ) as $component ) {
			$component->update( $from_version );
			// !!!! error handling ? !!!!, if WP_DEBUG ?
		};
		$this->register_installed_version( $this->plugin->get_version() );
	}

}
?>