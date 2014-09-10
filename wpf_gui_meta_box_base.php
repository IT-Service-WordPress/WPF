<?php

namespace WPF\v1\GUI\Meta\Box;

require_once ( 'wpf_gui_meta_box_ibase.php' );
require_once ( 'wpf_plugin_component_base.php' );
require_once ( 'wpf_gui_setting_page_control_ibase.php' );
require_once ( 'wpf_gui_templates.php' );

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

	// protected
	// WPF\v1\GUI\Setting\Page\Control\IBase&[]
	// $controls;

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

		/*
		$this->controls = array();
		$this->add_controls(
			array_slice( func_get_args(), 2 )
		);
		*/
	}

	public
	function add_controls(
		// произвольное количество WPF\v1\GUI\Setting\Page\Control\IBase&.
		$controls
	) {
		/*
		$control = $controls;
		if ( is_array( $controls ) || ( $controls instanceof \Traversable ) ) {
			foreach ( $controls as $control ) {
				$this->add_controls( $control );
			};
		} elseif ( $control instanceof \WPF\v1\GUI\Setting\Page\Control\IBase ) {
			$this->controls[] = $control;
		};
		*/
	}

	public
	function get_controls() {
		//return $this->controls;
	}

	public
	function bind_action_handlers_and_filters() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		add_action( 'save_post', array( $this, 'save_meta' ) );
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
		/*
		foreach ( $this->controls as $control ) {
			$control->bind_to_page_section( $this );
			$control->add_settings_field();
		};
		*/
	}

	protected
	function get_nonce_action() {
		return $this->get_id();
	}

	protected
	function get_nonce_name() {
		return $this->get_id() . '_nonce';
	}

	protected
	function nonce_field() {
		wp_nonce_field( $this->get_nonce_action(), $this->get_nonce_name() );
	}

	protected
	function meta_fields() {
		$this->nonce_field();
		// controls...
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
		if ( ! check_admin_referer( $this->get_nonce_action(), $this->get_nonce_name() ) ) return;
		// if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

		if (
			isset( $_POST[ 'post_type' ] )
			&& ( 'page' == $_POST[ 'post_type' ] )
		) {
			if ( ! current_user_can( 'edit_page', $post_id ) ) return;
		} else {
			if ( ! current_user_can( 'edit_post', $post_id ) ) return;
		};

		/*
		// metas ...
		if ( ! isset( $_POST[ 'myplugin_new_field' ] ) ) return;
		$my_data = sanitize_text_field( $_POST[ 'myplugin_new_field' ] );
		update_post_meta( $post_id, '_my_meta_value_key', $my_data );
		*/
	}

}
?>