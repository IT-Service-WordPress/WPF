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
		\add_action( 'uninstall_' . $this->plugin->get_basename(), array( &$this, 'uninstall' ) );
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
			$action = 'install_' . $this->plugin->get_basename();
			\add_action( $action, array( $this, 'install' ) );
			\do_action( $action );
		} elseif ( version_compare( 
			$prev_version
			, $this->plugin->get_version()
			, '<' 
		) ) {
			$action = 'update_' . $this->plugin->get_basename();
			\add_action( $action, array( $this, 'update' ) );
			\do_action( $action );
		};
		parent::activate();
	}

	public
	function deactivate() {
		parent::deactivate();
	}
	
	public
	function install() {
		$result = new \WP_Error();
		foreach ( $this->plugin->get_components( '\WPF\v1\Plugin\Component\IInstallable' ) as $component ) {
			$component->install();
			// !!!! error handling ? !!!!, if WP_DEBUG ?
		};
		$this->register_installed_version( $this->plugin->get_version() );
		$this->plugin->register_uninstall_hook(
			array( __CLASS__, '_uninstall' )
		);
		\do_action( 'after_install_' . $this->plugin->get_basename(), $result );
	}

	public
	static
	function _uninstall() {
		// stub, realy action - in `uninstall_<plugin_file>` action.
	}
	
	public
	function uninstall() {
		$result = new \WP_Error();
		foreach ( $this->plugin->get_components( '\WPF\v1\Plugin\Component\IInstallable' ) as $component ) {
			$component->uninstall();
			// !!!! error handling ? !!!!, if WP_DEBUG ?
		};
		$this->deregister_installed_version();
		\do_action( 'after_uninstall_' . $this->plugin->get_basename(), $result );
	}

	public
	function update() {
		$result = new \WP_Error();
		$prev_version = $this->get_installed_version();
		foreach ( $this->plugin->get_components( '\WPF\v1\Plugin\Component\IUpdatable' ) as $component ) {
			$component->update( $prev_version );
			// !!!! error handling ? !!!!, if WP_DEBUG ?
		};
		$this->register_installed_version( $this->plugin->get_version() );
		\do_action( 'after_update_' . $this->plugin->get_basename(), $result );
	}

	public
	function run_deffered_actions() {
		parent::run_deffered_actions();
		$this->plugin->run_deffered_actions(
			array( 'install', 'uninstall', 'update' )
			, true
		);
	}

}
?>