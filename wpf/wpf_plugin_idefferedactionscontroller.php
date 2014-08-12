<?php 

namespace WPF\v1\Plugin;

require_once ( 'wpf_inc.php' );

/*


@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
interface IDefferedActionsController {

	public
	function schedule_deffered_action(
		$action
		, $data = true
		, $ttl = 0
	);

	public
	function get_deffered_action(
		$action
	);

	public
	function reset_deffered_action(
		$action
	);

	public
	function run_deffered_actions(
		$actions // actions names
		, $reset = false
	);

}
?>