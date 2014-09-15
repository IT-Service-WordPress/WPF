<?php

namespace WPF\v1\GUI\DataManipulator;

require_once ( 'wpf_gui_controller_ibase.php' );
require_once ( 'wpf_gui_validator_ibase.php' );

/*
Options and metas manipulators (UI controls) common interface.

@since 1.1.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
interface IBase
{

	public
	function get_name();

	public
	function bind_controller(
		\WPF\v1\GUI\Controller\IBase& $controller
	);

	public
	// \WPF\v1\GUI\Controller\IBase&
	function get_controller();

	public
	// \WPF\v1\GUI\Validator\IBase&
	function get_validator();

	public
	function set_status(
		$message
		, $code = 'updated'
	);

}
?>