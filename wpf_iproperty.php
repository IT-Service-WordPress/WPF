<?php

namespace WPF\v1;

/*
Property wrapper interface.

@since 1.1.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/

interface IProperty
{

	public
	function get_name();

	public
	function get_value();

	public
	function set_value(
		$value
	);

	public
	function isset_value();

	public
	function unset_value();

}
?>