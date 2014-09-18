<?php

namespace WPF\v1\GUI\Control;

require_once ( 'wpf_gui_control_ibase.php' );
require_once ( 'wpf_gui_component_base.php' );
require_once ( 'wpf_gui_controller_ibase.php' );
require_once ( 'wpf_gui_validator_ibase.php' );
require_once ( 'wpf_gui_validator_base.php' );
require_once ( 'wpf_functions.php' );

/*
UI control base class.

@since 1.1.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
abstract
class Base
	extends
		\WPF\v1\GUI\Component\Base
	implements
		IBase
{

	protected
	$id;

	protected
	$data_name;

	protected
	$title;

	protected
	$description;

	protected
	$postfix;

	private
	// \WPF\v1\GUI\Controller\IBase&
	$controller;

	protected
	// \WPF\v1\GUI\Validator\IBase&
	$validator;

	public
	function __construct(
		$id
		, $data_name = null
		, $args = array()
		, $validator = null
	) {
		$properties = array_keys( get_object_vars( $this ) );
		foreach ( $properties as $property ) {
			if ( isset( $args[ $property ] ) ) {
				$this->$property = $args[ $property ];
			};
		};

		$this->id = $id;
		if ( null === $data_name ) {
			$data_name = $id;
		};
		if ( ! is_string( $data_name ) ) {
			_doing_it_wrong(
				__FUNCTION__
				, sprintf(
					__( 'Unsupported parameter <code>%1$s</code> type <code>%2$s</code>, expected <code>%3$s</code>.', \WPF\v1\WPF_ADMINTEXTDOMAIN )
					, 'data_name'
					, gettype( $data_name )
					, 'string'
				)
			);
		};
		$this->data_name = $data_name;
		if ( empty ( $this->title ) ) $this->title = $this->data_name;

		if ( $validator ) {
			if ( $validator instanceof \WPF\v1\GUI\Validator\IBase ) {
				$this->validator = $validator;
			} elseif ( is_callable( $validator ) ) {
				$this->validator = new \WPF\v1\GUI\Validator\Base( null, null, null, $validator );
			} else {
				_doing_it_wrong(
					__FUNCTION__
					, sprintf(
						__( 'Unsupported parameter <code>%1$s</code> type <code>%2$s</code>, expected <code>%3$s</code>.', \WPF\v1\WPF_ADMINTEXTDOMAIN )
						, 'validator'
						, gettype( $validator )
						, '\WPF\v1\GUI\Validator\IBase'
					)
				);
			};
			$this->validator->bind_datamanipulator( $this );
		};
	}

	public
	function bind_controller(
		\WPF\v1\GUI\Controller\IBase& $controller
	) {
		$this->controller = $controller;
	}

	public
	// \WPF\v1\GUI\Controller\IBase&
	function get_controller() {
		return $this->controller;
	}

	public
	function bind_action_handlers_and_filters() {
	}

	public
	function get_id() {
		return $this->id;
	}

	public
	function get_label() {
		return $this->title;
	}

	public
	function get_description() {
		return $this->description;
	}

	public
	function get_postfix() {
		return $this->postfix;
	}

	public
	function get_name() {
		return $this->data_name;
	}

	protected
	function get_value() {
		return $this->get_controller()->get_value( $this->get_name() );
	}

	public
	function set_value(
		$new_value
	) {
		return $this->get_controller()->set_value( $this->get_name(), $new_value );
	}

	public
	function isset_value() {
		return $this->get_controller()->isset_value( $this->get_name() );
	}

	public
	function unset_value() {
		return $this->get_controller()->unset_value( $this->get_name() );
	}

	public
	// \WPF\v1\GUI\Validator\IBase&
	function get_validator() {
		return $this->validator;
	}

	public
	function set_status(
		$message
		, $code = 'updated'
	) {
		$this->get_controller()->set_status(
			$this->get_name()
			, $message
			, $code
		);
	}

}
?>