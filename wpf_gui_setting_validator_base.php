<?php

namespace WPF\v1\GUI\Setting\Validator;

require_once ( 'wpf_gui_setting_validator_ibase.php' );
require_once ( 'wpf_functions.php' );

/*
Setting validator / sanitizer interface.

@since 1.1.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class Base
	implements
		IBase
{

	protected
	// \WPF\v1\GUI\Setting\IBase&
	$setting;

	protected
	$error_message;

	protected
	$success_message;

	protected
	$validator;

	protected
	$sanitizer;

	protected
	$params;

	public
	function __construct(
		$error_message
		, $success_message = false
		, $validator = null
		, $sanitizer = null
		// , $params
	) {
		$this->error_message = $error_message;
		$this->success_message = $success_message;

		if ( is_callable( $validator ) ) {
			$this->validator = $validator;
		} elseif ( is_int( $validator ) ) {
			$this->validator = function ( $value ) use( $validator ) {
				return \filter_var( $value, $validator );
			};
		} elseif ( is_null( $validator ) ) {
			$this->validator = $validator;
		} else {
			\WPF\v1\trigger_wpf_error(
				sprintf(
					__( 'Plugin coding error: unsupported parameter <code>%3$s</code> type <code>%4$s</code>.', \WPF\v1\WPF_ADMINTEXTDOMAIN )
					, '' // $this->plugin->get_title()
					, get_class( $this )
					, 'validator'
					, gettype( $validator )
				)
				, E_USER_ERROR
			);
		};

		if ( is_callable( $sanitizer ) ) {
			$this->sanitizer = $sanitizer;
		} elseif ( is_int( $sanitizer ) ) {
			$this->sanitizer = function ( $value ) use( $sanitizer ) {
				return \filter_var( $value, $sanitizer );
			};
		} elseif ( is_null( $sanitizer ) ) {
			$this->sanitizer = $sanitizer;
		} else {
			\WPF\v1\trigger_wpf_error(
				sprintf(
					__( 'Plugin coding error: unsupported parameter <code>%3$s</code> type <code>%4$s</code>.', \WPF\v1\WPF_ADMINTEXTDOMAIN )
					, '' // $this->plugin->get_title()
					, get_class( $this )
					, 'sanitizer'
					, gettype( $sanitizer )
				)
				, E_USER_ERROR
			);
		};

		$this->params = array_slice( func_get_args(), 4 );
	}

	public
	function bind(
		\WPF\v1\GUI\Setting\IBase& $setting
	) {
		$this->setting = $setting;
	}

	public
	function get_callback() {
		return array( &$this, 'validate' );
	}

	public
	function is_valid(
		$new_value
	) {
		if ( ! $this->validator ) {
			return true;
		} elseif ( ! $this->params ) {
			return call_user_func( $this->validator, $new_value );
		} else {
			return call_user_func_array( $this->validator, array_merge( array( $new_value ), $this->params ) );
		};
	}

	public
	function sanitize(
		$new_value
	) {
		if ( ! $this->sanitizer ) {
			return $new_value;
		} elseif ( ! $this->params ) {
			return call_user_func( $this->sanitizer, $new_value );
		} else {
			return call_user_func_array( $this->sanitizer, array_merge( array( $new_value ), $this->params ) );
		};
	}

	public
	function validate(
		$new_value
	) {
		$sanitized_value = $this->sanitize( $new_value );
		$old_value = $this->setting->get_value();
		$params = array_merge( array( $old_value, $new_value, $sanitized_value ), $this->params );
		if ( $this->is_valid( $sanitized_value ) ) {
			if ( $this->success_message ) {
				$this->setting->set_status_message(
					vsprintf( $this->success_message, $params )
					, 'updated'
				);
			};
			return $sanitized_value;
		} else {
			if ( $this->error_message ) {
				$this->setting->set_status_message(
					vsprintf( $this->error_message, $params )
					, 'error'
				);
			};
			return $old_value;
		};
	}

}
?>