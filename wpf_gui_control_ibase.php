<?php

namespace WPF\v1\GUI\Control;

require_once ( 'wpf_gui_datamanipulator_ibase.php' );
require_once ( 'wpf_ipluggable.php' );

/*
UI control interface.

@since 1.1.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
interface IBase
	extends
		\WPF\v1\GUI\DataManipulator\IBase
		, \WPF\v1\IPluggable
{

	public
	function get_id();

}
?>