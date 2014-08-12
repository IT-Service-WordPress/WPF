<?php 

namespace WPF\v1\Plugin\Component;

require_once ( 'wpf_inc.php' );

/*
Installable components base class.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
interface IDefferedActionsController
{

	public
	function run_deffered_actions(
		$actions = null // action names or empty for all actions
	);

}
?>