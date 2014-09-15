<?php

namespace WPF\v1;

/*

@since 1.1.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
interface IPluggable {

	public
	function bind_action_handlers_and_filters();

}
?>