<?php

namespace WPF\v1\GUI\Meta\Box;

require_once ( 'wpf_gui_meta_box_ibase.php' );
require_once ( 'wpf_gui_group_controller.php' );
require_once ( 'wpf_plugin_component_base.php' );
require_once ( 'wpf_gui_templates.php' );
require_once ( 'wpf_functions.php' );

/*
Meta box base class.

@since 1.1.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class Base
	extends
		\WPF\v1\Plugin\Component\Base
	implements
		IBase
{
	use \WPF\v1\GUI\Group\Controller;

	protected
	$id;

	protected
	$title;

	protected
	$post_type;

	protected
	$context;

	protected
	$priority;

	public
	function __construct(
		$id
		, $args
		// произвольное количество визуальных элементов
	) {
		parent::__construct();

		$this->context = 'advanced';
		$this->priority = 'default';
		$properties = array_keys( get_object_vars( $this ) );
		foreach ( $properties as $property ) {
			if ( isset( $args[ $property ] ) ) {
				$this->$property = $args[ $property ];
			};
		};
		$this->id = $id;
		if ( empty ( $this->title ) ) $this->title = $this->id;

		$this->_init_components();
		$this->add_components(
			array_slice( func_get_args(), 2 )
		);
	}

	public
	function get_page_hookname() {
		return 'page.php';
	}

	public
	function bind_action_handlers_and_filters() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		add_action( 'save_post', array( $this, 'save_meta' ) );
		add_action(
			'load-' . $this->get_page_hookname()
			, array( &$this, 'on_page_load' )
		);
	}

	public
	function get_id() {
		return $this->id;
	}

	public
	function get_title() {
		return $this->title;
	}

	public
	function get_post_type() {
		return $this->post_type;
	}

	public
	function get_context() {
		return $this->context;
	}

	public
	function get_priority() {
		return $this->priority;
	}

	public
	function add_meta_box() {
		\add_meta_box(
			$this->get_id()
			, $this->get_title()
			, array( &$this, 'display' )
			, $this->get_post_type()
			, $this->get_context()
			, $this->get_priority()
		);
	}

	protected
	function do_metas_fields() {
		foreach ( $this->get_controls() as $control ) {
			$data_manipulator = $control;
			/*
			\register_setting(
				$this->get_option_group()
				, $data_manipulator->get_name()
				, function (
					$new_value
				) use (
					$data_manipulator
					, $plugin
				) {
					if ( $validator = $data_manipulator->get_validator() ) {
						$new_value = call_user_func( $validator->get_callback(), $new_value );
					};
					$option = $plugin->get_options()->get( $data_manipulator->get_name() );
					$new_value = $option->sanitize_value( $new_value );
					return $new_value;
				}
			);
			\add_settings_field(
				$control->get_id()
				, $control->get_label()
				, array( $control, 'display' )
				, $this->get_page_slug()
				, $section->get_id()
				, array( 'label_for' => $control->get_id() )
			);
			*/
		};
	}

	public
	function display() {
		$_template_file = \WPF\v1\GUI\locate_template( 'meta_box.php' );
		require( $_template_file );
	}

	public
	function save_meta(
		$post_id
	) {
		/*
		// metas ...
		if ( ! isset( $_POST[ 'myplugin_new_field' ] ) ) return;
		$my_data = sanitize_text_field( $_POST[ 'myplugin_new_field' ] );
		update_post_meta( $post_id, '_my_meta_value_key', $my_data );
		*/
	}

	public
	function get_value(
		$name
	) {
		// return $this->get_plugin()->get_options()->$name;
	}

	public
	function set_value(
		$name
		, $new_value
	) {
		// return $this->get_plugin()->get_options()->$name = $new_value;
	}

	public
	function unset_value(
		$name
	) {
		// return $this->get_plugin()->get_options()->get( $name )->unset_value();
	}

	public
	function isset_value(
		$name
	) {
		// return $this->get_plugin()->get_options()->get( $name )->isset_value();
	}

	public
	function set_status(
		$name
		, $message
		, $code = 'updated'
	) {
		/*
		\add_settings_error(
			$name
			, 'settings_updated'
			, $message
			, $code
		);
		*/
	}

}
?>