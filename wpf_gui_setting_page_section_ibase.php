<?php

namespace WPF\v1\GUI\Setting\Page\Section;

require_once ( 'wpf_gui_setting_page_ibase.php' );
require_once ( 'wpf_gui_group_ibase.php' );
require_once ( 'wpf_gui_component_ibase.php' );

/*
Settings page section descriptor interface.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
interface IBase
	extends
		\WPF\v1\GUI\Component\IBase
		, \WPF\v1\GUI\Group\IBase
{

	public
	function get_id();

	public
	function get_title();

	public
	function display();

	public
	// \WPF\v1\GUI\Control\IBase&[]
	function get_controls();

}
?>