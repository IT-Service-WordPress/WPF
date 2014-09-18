<?php

namespace WPF\v1\GUI\Meta\Box;

require_once ( 'wpf_gui_meta_box_ibase.php' );
require_once ( 'wpf_gui_group_controller.php' );
require_once ( 'wpf_gui_templates.php' );
require_once ( 'wpf_plugin_component_base.php' );
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
		add_action( 'save_post_' . $this->get_post_type(), array( $this, 'save_meta' ) );
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

	public
	function display() {
		$_template_file = \WPF\v1\GUI\locate_template( 'meta_box.php' );
		require( $_template_file );
	}

	public
	function save_meta() {
		foreach ( $this->get_controls() as $data_manipulator ) {
			if ( isset( $_POST[ $name = $data_manipulator->get_name() ] ) ) {
				$new_value = $_POST[ $name ];
				$new_value = sanitize_text_field( $new_value );
				if ( $validator = $data_manipulator->get_validator() ) {
					$new_value = call_user_func( $validator->get_callback(), $new_value );
				};
				// $new_value = $this->get_plugin()->get_metas()->get( $name )->sanitize_value( $new_value );
				$this->set_value( $data_manipulator->get_name(), $new_value );
			};
		};
	}

	public
	function get_value(
		$name
	) {
		return $this->get_plugin()->get_post_metas()->$name;
	}

	public
	function set_value(
		$name
		, $new_value
	) {
		return $this->get_plugin()->get_post_metas()->$name = $new_value;
	}

	public
	function unset_value(
		$name
	) {
		return $this->get_plugin()->get_post_metas()->get( $name )->unset_value();
	}

	public
	function isset_value(
		$name
	) {
		return $this->get_plugin()->get_post_metas()->get( $name )->isset_value();
	}

	public
	function set_status(
		$name
		, $message
		, $code = 'updated'
	) {
		require_once ( 'wpf_gui_notice_scheduled.php' );
		$this->get_plugin()->add_components(
			new \WPF\v1\GUI\Notice\Scheduled( array(
				'message' => $message
				, 'message_type' => $code
			) )
		);
	}

}
?>