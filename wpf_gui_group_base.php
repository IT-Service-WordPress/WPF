<?php

namespace WPF\v1\GUI\Group;

require_once ( 'wpf_gui_group_ibase.php' );
require_once ( 'wpf_functions.php' );

/*
Settings page and meta box common functionality - collection of UI components.

@since 1.1.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
trait Base
{

	protected
	$components;

	private
	function _init_components() {
		$this->components = array();
	}

	public
	function add_components(
		$components
	) {
		$component = $components;
		if ( is_array( $components ) || ( $components instanceof \Traversable ) ) {
			foreach ( $components as $component ) {
				$this->add_components( $component );
			};
		} else {
			$this->add_component( $component );
		};
	}

	protected
	function add_component(
		\WPF\v1\GUI\Component\IBase& $component
	) {
		$this->components[] = $component;
	}

	public
	// \WPF\v1\Plugin\IBase&
	function get_plugin() {
		return ( $this instanceof \WPF\v1\GUI\Component\IBase ) ?
			$this->get_group()->get_plugin()
			: parent::get_plugin()
		;
	}

	protected
	function after_bind() {
		foreach ( $this->get_components() as $component ) {
			$component->bind_group( $this );
		};
	}

	public
	function get_components(
		$component_type = null // interface id, or null for all components
	) {
		if ( $component_type ) {
			return array_filter(
				$this->components
				, function ( $component ) use( $component_type ) { return ( $component instanceof $component_type ); }
			);
		} else {
			return $this->components;
		};
	}

	public
	function get_components_recursive(
		$component_type = null // interface id, or null for all components
	) {
		$found = $this->get_components( $component_type );
		foreach ( $this->get_components( '\WPF\v1\GUI\Group\IBase' ) as $group ) {
			$found = array_merge( $found, $group->get_components_recursive( $component_type ) );
		};
		return $found;
	}

	public
	function has_component(
		$component_type // interface id
	) {
		$found = false;
		foreach ( $this->components as $component ) {
			if ( $component instanceof $component_type ) {
				$found = true;
				break;
			};
		};
		return $found;
	}

	public
	// \WPF\v1\GUI\Control\IBase&[]
	function get_controls() {
		return $this->get_components( '\WPF\v1\GUI\Control\IBase' );
	}

	public
	function on_page_load() {
		foreach ( $this->components as $component ) {
			$component->on_page_load();
		};
	}

}
?>