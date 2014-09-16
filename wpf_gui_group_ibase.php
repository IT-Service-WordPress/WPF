<?php

namespace WPF\v1\GUI\Group;

require_once ( 'wpf_gui_component_ibase.php' );
require_once ( 'wpf_plugin_ilink.php' );

/*
Settings page and meta box common functionality - interface of collection of UI components.

@since 1.1.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
interface IBase
	extends
		\WPF\v1\Plugin\ILink
{

	public
	// \WPF\v1\GUI\Component\IBase&[]
	function get_components(
		$component_type = null // interface id, or null for all components
	);

	public
	// bool
	function has_component(
		$component_type // interface id
	);

}
?>