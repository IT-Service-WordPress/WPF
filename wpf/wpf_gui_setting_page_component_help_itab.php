<?php 

namespace WPF\v1\GUI\Setting\Page\Component\Help;

require_once ( 'wpf_inc.php' );
require_once ( 'wpf_gui_setting_page_component_help_ibase.php' );

/*
Settings page Help "tab" component interface.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
interface ITab
{

	public
	function bind_to_help(
		IBase& $help
	);

	public
	function get_id();

	public
	function get_title();

	public
	function get_content();

	public
	function add_help_tab();

}
?>