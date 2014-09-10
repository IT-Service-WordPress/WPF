<?php

namespace WPF\v1;

require_once ( 'wpf_iproperty.php' );
require_once ( 'wpf_functions.php' );

/*
Properties collection class.

@since 1.1.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class Properties
	implements
		\IteratorAggregate
{

	protected
	$items;

	public
	function __construct(
		$properties = array()
	) {
		$this->items = array();
		$this->add( $properties );
	}

	private
	function __clone() {}

    private
	function __sleep() {}

    private
	function __wakeup() {}

    public
	function getIterator() {
        return new \ArrayIterator( $this->items );
    }

	public
	function add(
		$properties
	) {
		if ( is_array( $properties ) || ( $properties instanceof \Traversable ) ) {
			foreach ( $properties as $property ) {
				$this->add( $property );
			};
		} else {
			$this->add_property( $properties );
		};
	}

	protected
	function add_property(
		IProperty $property
	) {
		$this->items[ $property->get_name() ] = $property;
	}

	public
	function get(
		$name
	) {
		if ( array_key_exists( $name, $this->items ) ) {
			return $this->items[ $name ];
		} else {
			\WPF\v1\trigger_wpf_error(
				sprintf(
					__( 'WPF error: undefined property <code>%1$s</code> in collection <code>%2$s</code>.', \WPF\v1\WPF_ADMINTEXTDOMAIN )
					, $name
					, get_class( $this )
				)
				, E_USER_WARNING
			);
			return null;
		};
	}

	public
	function __get(
		$name
	) {
		if ( array_key_exists( $name, $this->items ) ) {
			return $this->items[ $name ]->get_value();
		} else {
			\WPF\v1\trigger_wpf_error(
				sprintf(
					__( 'WPF error: undefined property <code>%1$s</code> in collection <code>%2$s</code>.', \WPF\v1\WPF_ADMINTEXTDOMAIN )
					, $name
					, get_class( $this )
				)
				, E_USER_WARNING
			);
			return null;
		};
	}

	public
	function __set(
		$name
		, $value
	) {
		if ( array_key_exists( $name, $this->items ) ) {
			return $this->items[ $name ]->set_value( $value );
		} else {
			\WPF\v1\trigger_wpf_error(
				sprintf(
					__( 'WPF error: undefined property <code>%1$s</code> in collection <code>%2$s</code>.', \WPF\v1\WPF_ADMINTEXTDOMAIN )
					, $name
					, get_class( $this )
				)
				, E_USER_WARNING
			);
			return null;
		};
	}

	public
	function __isset(
		$name
	) {
		if ( array_key_exists( $name, $this->items ) ) {
			return $this->items[ $name ]->isset_value();
		} else {
			\WPF\v1\trigger_wpf_error(
				sprintf(
					__( 'WPF error: undefined property <code>%1$s</code> in collection <code>%2$s</code>.', \WPF\v1\WPF_ADMINTEXTDOMAIN )
					, $name
					, get_class( $this )
				)
				, E_USER_WARNING
			);
			return null;
		};
	}

	public
	function __unset(
		$name
	) {
		if ( array_key_exists( $name, $this->items ) ) {
			return $this->items[ $name ]->unset_value();
		} else {
			\WPF\v1\trigger_wpf_error(
				sprintf(
					__( 'WPF error: undefined property <code>%1$s</code> in collection <code>%2$s</code>.', \WPF\v1\WPF_ADMINTEXTDOMAIN )
					, $name
					, get_class( $this )
				)
				, E_USER_WARNING
			);
			return null;
		};
	}

}
?>