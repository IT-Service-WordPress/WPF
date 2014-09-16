<?php

namespace WPF\v1\GUI\Setting\Page;

require_once ( 'wpf_gui_setting_page_ibase.php' );
require_once ( 'wpf_gui_setting_page_section_ibase.php' );
require_once ( 'wpf_gui_group_base.php' );
require_once ( 'wpf_functions.php' );

/*
Settings page descriptor base class.

@since 1.0.0

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
	use \WPF\v1\GUI\Group\Base;

	protected
	$parent_slug;

	protected
	$page_slug;

	public
	function __construct(
		$parent_slug
		, $page_slug
		, $sections // произвольное количество Section\IBase
	) {
		parent::__construct();

		$this->parent_slug = $parent_slug;
		$this->page_slug = $page_slug;

		$this->components = array();
		$this->add_components(
			array_slice( func_get_args(), 2 )
		);
	}

	public
	function get_sections() {
		return $this->get_components( '\WPF\v1\GUI\Setting\Page\Section\IBase' );
	}

	public
	function bind_action_handlers_and_filters() {
		$this->check_bind();
		\add_action( 'admin_menu', array( &$this, 'add_submenu_page' ) );
		// !!! network !!!
	}

	public
	function get_parent_slug() {
		return $this->parent_slug;
	}

	public
	function get_page_slug() {
		return $this->page_slug;
	}

	public
	function get_option_group() {
		return $this->get_page_slug();
	}

	public
	function get_menu_title() {
		return $this->get_page_title();
	}

	public
	function get_capability() {
		return 'manage_options';
	}

	public
	function get_page_hookname() {
		return get_plugin_page_hookname(
			$this->get_page_slug()
			, $this->get_parent_slug()
		);
	}

	public
	function add_submenu_page() {
		$this->do_add_submenu_page();
		$this->do_settings();
		\add_action(
			'load-' . $this->get_page_hookname()
			, array( &$this, 'on_page_load' )
		);
	}

	protected
	function do_add_submenu_page() {
	}

	public
	function on_page_load() {
		foreach ( $this->components as $component ) {
			$component->on_page_load();
		};
	}

	public
	function get_value(
		$name
	) {
		return $this->get_plugin()->get_options()->$name;
	}

	public
	function set_value(
		$name
		, $new_value
	) {
		return $this->get_plugin()->get_options()->$name = $new_value;
	}

	public
	function unset_value(
		$name
	) {
		return $this->get_plugin()->get_options()->get( $name )->unset_value();
	}

	public
	function isset_value(
		$name
	) {
		return $this->get_plugin()->get_options()->get( $name )->isset_value();
	}

	public
	function set_status(
		$name
		, $message
		, $code = 'updated'
	) {
		\add_settings_error(
			$name
			, 'settings_updated'
			, $message
			, $code
		);
	}

	protected
	function do_settings() {
		$plugin = $this->get_plugin();
		foreach ( $this->get_sections() as $section ) {
			\add_settings_section(
				$section->get_id()
				, $section->get_title()
				, array( $section, 'display' )
				, $this->get_page_slug()
			);
			foreach ( $section->get_controls() as $control ) {
				$data_manipulator = $control;
				$data_manipulator->bind_controller( $this );
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
			};
		};
	}

}
?>