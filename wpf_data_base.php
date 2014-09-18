<?php

namespace WPF\v1\Data;

require_once ( 'wpf_data_ibase.php' );
require_once ( 'wpf_plugin_component_iinstallable.php' );
require_once ( 'wpf_plugin_component_updatable.php' );

/*
Option, metas and other data basic wrapper class.

@since 1.1.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
abstract
class Base
	extends
		\WPF\v1\Plugin\Component\Updatable
	implements
		IBase
		, \WPF\v1\Plugin\Component\IInstallable
{

	protected
	$name;

	protected
	$default_value;

	protected
	$delete_on_deactivate;

	protected
	$delete_on_uninstall;

	protected
	$serialize;

	public
	function __construct(
		$name
		, $args = array()
	) {
		parent::__construct();
		$this->delete_on_deactivate = false;
		$this->delete_on_uninstall = true;
		$properties = array_keys( get_object_vars( $this ) );
		foreach ( $properties as $property ) {
			if ( isset( $args[ $property ] ) ) {
				$this->$property = $args[ $property ];
			};
		};
		if ( ! is_string( $name ) ) {
			_doing_it_wrong(
				__FUNCTION__
				, sprintf(
					__( 'Unsupported parameter <code>%1$s</code> type <code>%2$s</code>, expected <code>%3$s</code>.', \WPF\v1\WPF_ADMINTEXTDOMAIN )
					, 'name'
					, gettype( $name )
					, 'string'
				)
			);
		};
		$this->name = $name;
	}

	final
	public
	function get_name() {
		return $this->name;
	}

	final
	public
	function get_value() {
		$value = $this->_get_value();
		return ( $this->serialize && $this->is_wrapped( $value ) ) ?
			$this->unwrap( $value )
			: $value
		;
	}

	final
	public
	function set_value(
		$new_value
	) {
		return $this->_set_value(
			$this->serialize ? $this->wrap( $new_value ) : $new_value
		);
	}

	abstract
	protected
	function _get_value();

	abstract
	protected
	function _set_value(
		$new_value
	);

	public
	function sanitize_value(
		$new_value
	) {
		return $new_value;
	}

	abstract
	public
	function isset_value();

	abstract
	public
	function unset_value();

	abstract
	public
	function add_value();

	abstract
	public
	function delete_value();

	public
	function activate() {
	}

	public
	function deactivate() {
		if ( $this->delete_on_deactivate ) {
			$this->delete_value();
		};
	}

	public
	function install() {
		if ( ! $this->isset_value() ) {
			$this->add_value();
		};
	}

	public
	function uninstall() {
		if ( $this->delete_on_uninstall ) {
			$this->delete_value();
		};
	}

	public
	function update(
		$from_version
	) {
		$this->install();
	}

	protected
	function is_wrapped(
		$value
	) {
		return is_array( $value );
	}

	protected
	function wrap(
		$value
	) {
		return array( $value );
	}

	protected
	function unwrap(
		$value
	) {
		return $value[ 0 ];
	}

}
?>