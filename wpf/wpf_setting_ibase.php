<?php 

namespace WPF\v1\Setting;

require_once ( 'wpf_inc.php' );
require_once ( 'wpf_plugin_component_iinstallable.php' );

/*
Setting descriptor interface.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
interface IBase
	extends
		\WPF\v1\Plugin\Component\IInstallable
{

	public
	// string
	function get_option_id();

	public
	function get_option_name();

	public
	function get_value();

	public
	// return error, if sanitize callback return error, or true
	function set_value();

}
?>