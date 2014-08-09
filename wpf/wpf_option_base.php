<?php 

namespace WPF\v1\Option;

require_once ( 'wpf_inc.php' );
require_once ( 'wpf_option_ibase.php' );
require_once ( 'wpf_plugin_component_updatable.php' );

/*
Option descriptor base class.

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
	$option_id;

	protected
	$option_name;
	
	protected
	$default_value;

	protected
	// bool
	$autoload;

	public
	function __construct(
		$id // option name without plugin prefix
		, $value = null
		, $autoload = true
	) {
		parent::__construct();
		$this->option_id = $id;
		$this->default_value = $value;
		$this->autoload = $autoload;
	}

	public
	// string
	function get_option_id() {
		return $this->option_id;
	}

	public
	function get_option_name() {
		if ( ! $this->option_name ) {
			$this->option_name = $this->plugin->get_namespace() . '-' . $this->option_id;
		};
		return $this->option_name;
	}

	public
	function get_value() {
	}

	public
	// return error, if sanitize callback return error, or true
	function set_value() {
	}

	public
	function activate() {
	}
	
	public
	function deactivate() {
	}

	public
	function install() {
		\add_option(
			$this->get_option_name()
			, $this->default_value ? $this->default_value : ''
			, ''
			, $this->autoload ? 'yes' : 'no'
		);
		// !!!! netwotk wide ? !!!! add_site_option
	}
	
	public
	function uninstall() {
		\delete_option(
			$this->get_option_name()
		);
		// !!!! netwotk wide ? !!!! delete_site_option
	}
	
	public
	function update(
		$from_version
	) {
		$this->install();
	}
	
	public
	function bind_action_handlers_and_filters() {
		parent::bind_action_handlers_and_filters();
	}

}
?>