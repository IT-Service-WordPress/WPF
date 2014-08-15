<?php 

namespace WPF\v1\GUI\Setting\Page\Component\Help;

require_once ( 'wpf_inc.php' );
require_once ( 'wpf_gui_setting_page_component_help_ibase.php' );

/*
Settings page Help "tab" and sidebar base interface.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
interface IComponent
{

	public
	function bind_to_help(
		IBase& $help
	);

	public
	function add_help();

}
?>