<?php

namespace WPF\v1\Setting;

\_deprecated_file( __FILE__, '1.1', 'wpf_option_serializable.php' ); // https://github.com/IT-Service-WordPress/WPF/issues/48

require_once ( 'wpf_setting_base.php' );

/*
Serializable setting descriptor class.

@since 1.0.0

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
	function _sanitize(
		$new_value
	) {
		if ( $this->sanitize_callback ) {
			$new_value = call_user_func( $this->sanitize_callback, $new_value );
		};
		if ( ! $this->is_wrapped( $new_value ) ) {
			$new_value = $this->wrap( $new_value );
		};
		return $new_value;
	}

	public
	function get_sanitize_callback() {
		return array( $this, '_sanitize' );
	}

	public
	function get_value() {
		return $this->unwrap( parent::get_value() );
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