<?php 

namespace WPF\v1\GUI\Setting\Page\Component;

require_once ( 'wpf_plugin_component_ibase.php' );
require_once ( 'wpf_gui_setting_page_ibase.php' );

/*
Settings page component interface.

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
	function bind_to_page(
		\WPF\v1\GUI\Setting\Page\IBase& $page
	);

	public
	function on_page_load();

}
?>