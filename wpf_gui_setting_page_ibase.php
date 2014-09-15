<?php

namespace WPF\v1\GUI\Setting\Page;

require_once ( 'wpf_plugin_component_ibase.php' );
require_once ( 'wpf_gui_controller_ibase.php' );
require_once ( 'wpf_gui_setting_page_section_ibase.php' );

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
		, \WPF\v1\GUI\Controller\IBase
{

	public
	function get_parent_slug();

	public
	function get_page_slug();

	public
	function get_page_hookname();

	public
	function get_option_group();

	public
	function add_components(
		// произвольное количество ISection, string или Component\IBase. В случае строк - строки являются идентификаторами отдельно загружаемых секций.
		$components
	);

	public
	function get_components(
		$component_type = null // interface id, or null for all components
	);

	public
	function has_component(
		$component_type // interface id
	);

	public
	function get_sections();

}
?>