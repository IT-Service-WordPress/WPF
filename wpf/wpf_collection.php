<?php 

namespace WPF\v1;

require_once ( 'wpf_inc.php' );

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
	$items;

	public
	function __construct( 
		// неопределённое количество компонентов больше одного, в том числе - массивы компонентов
	) {
		$this->items = array();
		$this->add( func_get_args() );
	}
	
	public
	function add(
		$items
	) {
		if ( is_array( $items ) || ( $items instanceof \Traversable ) ) {
			foreach ( $items as $item ) {
				$this->add( $item );
			};
		} else {
			$this->items[] = $items;
		};
	}
	
    public
	function getIterator() {
        return new \ArrayIterator( $this->items );
    }

	private
	function __clone() {}

    private
	function __sleep() {}

    private
	function __wakeup() {}
}
?>