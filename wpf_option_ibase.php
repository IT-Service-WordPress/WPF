<?php

namespace WPF\v1\Option;

require_once ( 'wpf_iproperty.php' );
require_once ( 'wpf_plugin_component_iinstallable.php' );

/*
Option descriptor interface.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
interface IBase
	extends
		\WPF\v1\IProperty
		, \WPF\v1\Plugin\Component\IInstallable
{

	public
	function sanitize_value(
		$new_value
	);

}
?>