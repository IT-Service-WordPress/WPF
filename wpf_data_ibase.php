<?php

namespace WPF\v1\Data;

require_once ( 'wpf_iproperty.php' );

/*
Options, metas and other data common interface.

@since 1.1.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
interface IBase
	extends
		\WPF\v1\IProperty
{

	public
	function add_value();

	public
	function delete_value();

}
?>