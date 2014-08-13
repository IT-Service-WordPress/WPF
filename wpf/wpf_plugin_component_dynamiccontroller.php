<?php 

namespace WPF\v1\Plugin\Component;

require_once ( 'wpf_inc.php' );
require_once ( 'wpf_plugin_component_base.php' );
require_once ( 'wpf_plugin_component_activable.php' );
require_once ( 'wpf_plugin_component_idynamiccontroller.php' );

/*
Dynamics components controller class.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class DynamicController
	extends
		Activable
	implements
		IDynamicController
{

	protected
	$components;
	
	protected
	$restoring_in_progress;

	public
	function __construct() {
		parent::__construct();
		$this->components = array();
		$this->restoring_in_progress = false;
	}

	public
	function bind(
		\WPF\v1\Plugin\IBase& $plugin
	) {
		parent::bind( $plugin );
		$this->restore_components();
	}

	public
	function add_components(
		$components
	) {
		if ( $this->restoring_in_progress ) return;
		if ( is_array( $components ) ) {
			$this->components = array_merge( $this->components, $components );
		} else {
			$this->components[] = &$components;
		};
		$this->save_components();
	}

	public
	function remove_components(
		$components
	) {
		if ( $this->restoring_in_progress ) return;
		if ( ! is_array( $components ) ) {
			$components = array ( $components );
		};
		foreach ( $components as $component ) {
			if ( ( $key = array_search( $component, $this->components, true ) ) !== false ) {
				unset( $this->components[ $key ] );
			};
		};
		$this->components = array_values( $this->components );
		$this->save_components();
	}

	public
	function restore_components() {
		$this->restoring_in_progress = true;
		// !!! network wide multisite ? !!!
		$components = \get_transient(
			$this->get_transient_name()
		);
		if ( $components ) {
			$this->components = $components;
			$this->plugin->add_components( $this->components );
		};
		$this->restoring_in_progress = false;
	}

	public
	function save_components() {
		if ( $this->restoring_in_progress ) return;
		// !!! network wide multisite ? !!!
		if ( empty( $this->components ) ) {
			\delete_transient(
				$this->get_transient_name()
			);
		} else {
			\set_transient(
				$this->get_transient_name()
				, $this->components
			);
		};
	}

	public
	function get_transient_name() {
		return $this->plugin->get_namespace() . '-dyn_comps';
	}

	public
	function activate() {
	}

	public
	function deactivate() {
		// !!! network wide multisite ? !!!
		\delete_transient(
			$this->get_transient_name()
		);
	}

}
?>