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

	public
	function __construct( 
	) {
	}

	public
	// string
	function get_option_id() {
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