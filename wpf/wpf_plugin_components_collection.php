<?php 

namespace WPF\v1\Plugin\Component;

require_once ( 'wpf_inc.php' );
require_once ( 'iwpf_plugin_component.php' );

/*
Just collection.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class Collection
	implements
		\IteratorAggregate 
{

	protected
	// IBase&[]
	$components;

	public
	function __construct( 
		/* IBase& */ $components // неопределённое количество компонентов больше одного, в том числе - массивы компонентов
	) {
		$this->components = array();
		$this->add_components( func_get_args() );
	}
	
	protected
	function add_components(
		/* IBase& or IBase&[] */ $components
	) {
		if ( is_array( $components ) ) {
			foreach ( (array) $components as $component ) {
				$this->add_components( $component );
			};
		} else {
			if ( $components instanceof IBase ) {
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