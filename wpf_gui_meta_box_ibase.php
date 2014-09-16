<?php

namespace WPF\v1\GUI\Meta\Box;

require_once ( 'wpf_plugin_component_ibase.php' );
require_once ( 'wpf_gui_group_ibase.php' );
require_once ( 'wpf_gui_controller_ibase.php' );

/*
Meta box descriptor interface.

@since 1.1.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
interface IBase
	extends
		\WPF\v1\Plugin\Component\IBase
		, \WPF\v1\GUI\Group\IBase
		, \WPF\v1\GUI\Controller\IBase
{

	public
	function get_id();

	public
	function get_title();

	public
	function get_post_type();

	public
	function get_context();

	public
	function get_priority();

}
?>