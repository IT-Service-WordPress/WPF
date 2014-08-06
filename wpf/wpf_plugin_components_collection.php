<?php 

namespace WPF\v1;

require_once ( 'wpf_inc.php' );
require_once ( 'iwpf_plugin_component.php' );

/*
WPF_Plugin_Components_Collection class. Just collection.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class WPF_Plugin_Components_Collection
	implements
		\IteratorAggregate 
{

	protected
	// IWPF_Plugin_Component&[]
	$components;

	public
	function __construct( 
		/* IWPF_Plugin_Component& */ $components // неопределённое количество компонентов больше одного, в том числе - массивы компонентов
	) {
		$this->components = array();
		$this->add_components( func_get_args() );
	}
	
	protected
	function add_components(
		/* IWPF_Plugin_Component& or IWPF_Plugin_Component&[] */ $components
	) {
		if ( is_array( $components ) ) {
			foreach ( (array) $components as $component ) {
				$this->add_components( $component );
			};
		} else {
			if ( $components instanceof IWPF_Plugin_Component ) {
				$this->components[] = $components;
			} else {
				// !!!! throw error !!!!
			};
		};
	}
	
    public
	function getIterator() {
        return new \ArrayIterator( $this->components );
    }

	private
	function __clone() {}

    private
	function __sleep() {}

    private
	function __wakeup() {}
}
?>