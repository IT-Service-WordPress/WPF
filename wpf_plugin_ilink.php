<?php

namespace WPF\v1\Plugin;

require_once ( 'wpf_plugin_ibase.php' );

/*

@since 1.1.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
interface ILink
{

	public
	// \WPF\v1\Plugin\IBase&
	function get_plugin();

}
?>