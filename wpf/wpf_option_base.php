<?php 

namespace WPF\v1\Option;

require_once ( 'wpf_inc.php' );
require_once ( 'wpf_option_ibase.php' );
require_once ( 'wpf_plugin_component_installable.php' );

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
		\WPF\v1\Plugin\Component\Installable
	implements
		IBase
{

	protected
	$option_id;
	
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
	function get_value() {
	}

	public
	// return error, if sanitize callback return error, or true
	function set_value() {
	}

	public
	function activate() {
		\add_option(
			$this->option_id
			, $this->default_value ? $this->default_value : ''
			, ''
			, $this->autoload ? 'yes' : 'no'
		);
		// !!!! netwotk wide ? !!!! add_site_option
	}
	
	public
	function deactivate() {
		\delete_option(
			$this->option_id
		);
		// !!!! netwotk wide ? !!!! delete_site_option
	}

	public
	function install() {
	}
	
	public
	function uninstall() {
	}
	
	public
	function bind_action_handlers_and_filters() {
		parent::bind_action_handlers_and_filters();
	}

}
?>