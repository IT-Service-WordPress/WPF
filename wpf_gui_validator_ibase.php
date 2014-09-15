<?php

namespace WPF\v1\GUI\Validator;

require_once ( 'wpf_gui_setting_ibase.php' );

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
	function bind(
		\WPF\v1\GUI\Setting\IBase& $setting
	);

	public
	function get_callback();

}
?>