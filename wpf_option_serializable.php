<?php

namespace WPF\v1\Option;

require_once ( 'wpf_option_base.php' );

/*
Serializable option class.

@since 1.1.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class Serializable
	extends
		Base
{

	public
	function get_value() {
		$value = parent::get_value();
		return ( $this->is_wrapped( $value ) ) ?
			$this->unwrap( $value )
			: $value
		;
	}

	public
	function set_value(
		$new_value
	) {
		$new_value = $this->wrap( $new_value );
		return parent::set_value( $new_value );
	}

	public
	function sanitize_value(
		$value
	) {
		return ( $this->is_wrapped( $value ) ) ?
			$value
			: $this->wrap( $value )
		;
	}

	protected
	function is_wrapped(
		$value
	) {
		return is_array( $value );
	}

	protected
	function wrap(
		$value
	) {
		return array( $value );
	}

	protected
	function unwrap(
		$value
	) {
		return $value[ 0 ];
	}

}
?>