<?php

namespace WPF\v1\GUI\Component;

require_once ( 'wpf_gui_group_ibase.php' );

/*
UI component interface.

@since 1.1.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
interface IBase
{

	public
	function bind_group(
		\WPF\v1\GUI\Group\IBase& $group
	);

	public
	// \WPF\v1\GUI\Group\IBase&
	function get_group();

	public
	function on_page_load();

}
?>