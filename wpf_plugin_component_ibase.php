<?php

namespace WPF\v1\Plugin\Component;

require_once ( 'wpf_ipluggable.php' );

/*

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
interface IBase
	extends
		\WPF\v1\IPluggable
{

	public
	function bind( \WPF\v1\Plugin\IBase& $plugin );

	public
	// \WPF\v1\Plugin\IBase&
	function get_plugin();

}
?>