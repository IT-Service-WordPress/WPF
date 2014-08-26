<?php 

namespace WPF\v1\Plugin\Component;

require_once ( 'wpf_plugin_component_iinstallable.php' );

/*

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
interface IUpdatable
	extends
		IInstallable
{

	public
	function update(
		$from_version
	);

}
?>