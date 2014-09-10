<?php

namespace WPF\v1\Setting\Validate;

\_deprecated_file( __FILE__, '1.1', 'wpf_gui_setting_validator_ibase.php' ); // https://github.com/IT-Service-WordPress/WPF/issues/48

require_once ( 'wpf_setting_ibase.php' );

/*
Setting validator / sanitizer interface.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
interface IBase
{

	public
	function bind(
		\WPF\v1\Setting\IBase& $setting
	);

	public
	function get_callback();

}
?>