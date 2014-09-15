<?php

namespace WPF\v1\GUI\Validator;

require_once ( 'wpf_gui_datamanipulator_ibase.php' );

/*
Setting validator / sanitizer interface.

@since 1.1.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
interface IBase
{

	public
	function bind_datamanipulator(
		\WPF\v1\GUI\DataManipulator\IBase& $data_manipulator
	);

	public
	function get_callback();

}
?>