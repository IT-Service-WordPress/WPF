<?php

namespace WPF\v1\GUI\Notice;

require_once ( 'wpf_gui_notice_todo.php' );

/*

@since 1.1.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class Scheduled
	extends
		ToDo
{

	public
	function __sleep() {
		return array(
			'message'
			, 'message_type'
		);
	}

}
?>