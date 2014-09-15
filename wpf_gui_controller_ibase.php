<?php

namespace WPF\v1\GUI\Controller;

/*
Base interface for settings and metas UI controls controllers.

@since 1.1.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
interface IBase
{

	public
	function get_value(
		$name
	);

	public
	function set_value(
		$name
		, $new_value
	);

	public
	function unset_value(
		$name
	);

	public
	// bool
	function isset_value(
		$name
	);

	public
	function set_status(
		$name
		, $message
		, $code = 'updated'
	);

}
?>