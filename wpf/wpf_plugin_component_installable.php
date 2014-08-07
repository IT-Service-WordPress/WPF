<?php 

namespace WPF\v1\Plugin\Component;

require_once ( 'wpf_inc.php' );
require_once ( 'wpf_plugin_component_activable.php' );
require_once ( 'wpf_plugin_component_iinstallable.php' );

/*
Installable components base class.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
abstract
class Installable
	extends
		Activable
	implements
		IInstallable
{

	protected
	function get_dependencies() {
		return array_merge(
			parent::get_dependencies()
			, array( '\WPF\v1\Plugin\Component\IInstaller' )
		);
	}

}
?>