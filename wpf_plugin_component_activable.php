<?php 

namespace WPF\v1\Plugin\Component;

require_once ( 'wpf_plugin_component_base.php' );
require_once ( 'wpf_plugin_component_dependable.php' );
require_once ( 'wpf_plugin_component_iactivable.php' );

/*
Activable components base class.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
abstract
class Activable
	extends
		Dependable
	implements
		IActivable
{

	public
	function get_dependencies() {
		return array( '\WPF\v1\Plugin\Component\IActivator' );
	}

}
?>