<?php 

namespace WPF\v1\GUI\Setting\Page;

require_once ( 'wpf_inc.php' );
require_once ( 'wpf_plugin_component_ibase.php' );

/*
Settings page descriptor interface.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
interface IBase
	extends
		\WPF\v1\Plugin\Component\IBase
{

	public
	function get_page_title();

	public
	function get_menu_title();

	public
	function get_capability();

	public
	function get_page_slug();

	public
	function add_settings_page();

	public
	function display();

}
?>