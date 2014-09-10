<?php

namespace WPF\v1\Option;

require_once ( 'wpf_option_ibase.php' );
require_once ( 'wpf_plugin_component_updatable.php' );

/*
Option descriptor class.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class Base
	extends
		\WPF\v1\Plugin\Component\Updatable
	implements
		IBase
{

	protected
	$option_name;

	protected
	$default_value;

	protected
	// bool
	$autoload;

	public
	function __construct(
		$option_name
		, $default_value = null
		, $autoload = true
	) {
		parent::__construct();
		$this->option_name = $option_name;
		$this->default_value = $default_value;
		$this->autoload = $autoload;
	}

	public
	function bind_action_handlers_and_filters() {
		parent::bind_action_handlers_and_filters();
	}

	public
	function get_name() {
		return $this->option_name;
	}

	public
	function get_value() {
		return \get_option( $this->get_name(), $this->default_value );
	}

	public
	function set_value(
		$new_value
	) {
		\update_option( $this->get_name(), $new_value );
	}

	public
	function isset_value() {
		return ( ! is_null( \get_option( $this->get_name(), null ) ) );
	}

	public
	function unset_value() {
		return \update_option( $this->get_name(), $this->default_value );
	}

	public
	function activate() {
	}

	public
	function deactivate() {
	}

	public
	function install() {
		$this->add_option();
	}

	public
	function uninstall() {
		$this->delete_option();
	}

	public
	function update(
		$from_version
	) {
		$this->install();
	}

	protected
	function add_option() {
		\add_option(
			$this->get_name()
			, $this->default_value ? $this->default_value : ''
			, ''
			, $this->autoload ? 'yes' : 'no'
		);
		// !!!! netwotk wide ? !!!! add_site_option
	}

	protected
	function delete_option() {
		\delete_option(
			$this->get_name()
		);
		// !!!! netwotk wide ? !!!! delete_site_option
	}

}
?>