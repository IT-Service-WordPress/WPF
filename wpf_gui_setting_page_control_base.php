<?php

namespace WPF\v1\GUI\Setting\Page\Control;

require_once ( 'wpf_gui_setting_page_control_ibase.php' );
require_once ( 'wpf_gui_setting_page_ibase.php' );
require_once ( 'wpf_gui_setting_page_section_ibase.php' );
require_once ( 'wpf_gui_setting_validator_ibase.php' );
require_once ( 'wpf_functions.php' );

/*
Settings page control base class.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
abstract
class Base
	implements
		IBase
{

	protected
	$id;

	protected
	$option_name;

	protected
	// \WPF\v1\Option\IBase&
	$option;

	protected
	$title;

	protected
	$description;

	protected
	$postfix;

	protected
	// \WPF\v1\GUI\Setting\Page\Section\IBase&
	$section;

	protected
	$sanitize_callback;

	public
	function __construct(
		$id
		, $option = null
		, $args = array()
		, $sanitize_callback = null
	) {
		$properties = array_keys( get_object_vars( $this ) );
		foreach ( $properties as $property ) {
			if ( isset( $args[ $property ] ) ) {
				$this->$property = $args[ $property ];
			};
		};

		$this->id = $id;
		if ( null === $option ) {
			$option = $id;
		};
		if ( $option instanceof \WPF\v1\Option\IBase ) {
			$this->option = $option;
			$this->option_name = $this->option->get_name();
		} elseif ( is_string( $option ) ) {
			$this->option_name = $option;
		} else {
			\WPF\v1\trigger_wpf_error(
				sprintf(
					__( 'Plugin coding error: unsupported parameter <code>%3$s</code> type <code>%4$s</code>.', \WPF\v1\WPF_ADMINTEXTDOMAIN )
					, '' // $this->plugin->get_title()
					, get_class( $this )
					, 'option'
					, gettype( $option )
				)
				, E_USER_ERROR
			);
		};
		if ( empty ( $this->title ) ) $this->title = $this->option_name;

		if ( $sanitize_callback ) {
			if ( $sanitize_callback instanceof \WPF\v1\GUI\Setting\Validator\IBase ) {
				$sanitize_callback->bind( $this );
				$this->sanitize_callback = $sanitize_callback->get_callback();
			} elseif ( is_callable( $sanitize_callback ) ) {
				$this->sanitize_callback = $sanitize_callback;
			} else {
				\WPF\v1\trigger_wpf_error(
					sprintf(
						__( 'Plugin coding error: unsupported parameter <code>%3$s</code> type <code>%4$s</code>.', \WPF\v1\WPF_ADMINTEXTDOMAIN )
						, '' // $this->plugin->get_title()
						, get_class( $this )
						, 'sanitize_callback'
						, gettype( $sanitize_callback )
					)
					, E_USER_ERROR
				);
			};
		};
	}

	public
	function bind_to_page_section(
		\WPF\v1\GUI\Setting\Page\Section\IBase& $section
	) {
		$this->section = $section;
		\add_action( 'admin_init', array( &$this, 'register_setting' ) );
	}

	protected
	function get_plugin() {
		return $this->section->get_plugin();
	}

	public
	function get_id() {
		return $this->id;
	}

	public
	function get_option_name() {
		return $this->option_name;
	}

	public
	function get_option_group() {
		return $this->section->get_page()->get_option_group();
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
		return $this->option_name;
	}

	protected
	function get_option() {
		if ( ! $this->option ) {
			$this->option = $this->get_plugin()->get_options()->get( $this->get_name() );
		};
		return $this->option;
	}

	public
	function get_value() {
		return $this->get_option()->get_value();
	}

	public
	function set_value(
		$new_value
	) {
		return $this->get_option()->set_value( $new_value );
	}

	public
	function isset_value() {
		return $this->get_option()->isset_value();
	}

	public
	function unset_value() {
		return $this->get_option()->unset_value();
	}

	public
	function get_option_value() {
		\_deprecated_function ( __FUNCTION__, '1.1', __CLASS__ . '::' . 'get_value()' );
		return $this->get_value();
	}

	public
	function get_sanitize_callback() {
		return $this->sanitize_callback ? $this->sanitize_callback : '';
	}

	public
	function register_setting() {
		\register_setting(
			$this->get_option_group()
			, $this->get_name()
			, $this->get_sanitize_callback()
		);
	}

	public
	function unregister_setting() {
		\unregister_setting(
			$this->get_option_group()
			, $this->get_name()
			, $this->get_sanitize_callback()
		);
	}

	public
	function add_settings_field() {
		\add_settings_field(
			$this->get_id()
			, $this->get_label()
			, array( &$this, 'display' )
			, $this->section->get_page_slug()
			, $this->section->get_id()
			, array( 'label_for' => $this->get_id() )
		);
	}

	public
	function set_status_message(
		$message
		, $code = 'updated'
	) {
		\add_settings_error(
			$this->get_name()
			, 'settings_updated'
			, $message
			, $code
		);
	}

}
?>