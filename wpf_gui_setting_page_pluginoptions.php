<?php

namespace WPF\v1\GUI\Setting\Page;

require_once ( 'wpf_gui_setting_page_base.php' );
require_once ( 'wpf_plugin_component_todo.php' );
require_once ( 'wpf_gui_setting_page_component_help_base.php' );
require_once ( 'wpf_gui_setting_page_component_help_plugindata.php' );

/*
Plugin settings page descriptor base class.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class PluginOptions
	extends
		Base
{

	public
	function __construct(
		// произвольное количество ISection или string. В случае строк - строки являются идентификаторами отдельно загружаемых секций.
	) {
		parent::__construct(
			'options-general.php'
			, ''
			, func_get_args()
		);

		if ( ! $this->has_component( '\WPF\v1\GUI\Setting\Page\Component\Help\IBase' ) ) {
			$this->add_components(
				new Component\Help\Base(
					new Component\Help\PluginData()
				)
			);
		};
	}

	public
	function bind_action_handlers_and_filters() {
		parent::bind_action_handlers_and_filters();
		\add_action( 'pre_current_active_plugins', array( &$this, '_add_settings_page_link' ) );

		\add_action( 'after_install_' . $this->plugin->get_basename(), array( &$this, 'schedule_review_settings_notice' ) );
		\add_action( 'after_update_' . $this->plugin->get_basename(), array( &$this, 'schedule_review_settings_notice' ) );
		// \add_action( 'after_activate_' . $this->plugin->get_basename(), array( &$this, 'schedule_review_settings_notice' ) ); // just for test
	}

	public
	function get_page_url() {
		return add_query_arg(
			'page'
			, $this->get_page_slug()
			, \self_admin_url( 'options-general.php' )
		);
	}

	public
	function schedule_review_settings_notice() {
		$this->plugin->add_components(
			new \WPF\v1\Plugin\Component\ToDo(
				sprintf(
					__( '<a href="%2$s">Review plugin "%1$s" settings</a>. Plugin was installed or updated.', \WPF\v1\WPF_ADMINTEXTDOMAIN )
					, $this->plugin->get_title( false )
					, $this->get_page_url()
				)
				, array(
					'plugins.php'
					, 'options-general.php'
					, 'update-core.php'
					, 'index.php'
				)
				, 'manage_options'
				, $this->get_page_hookname()
			)
		);
	}

	final
	public
	function _add_settings_page_link() {
		\add_filter( 'plugin_action_links_' . $this->plugin->get_basename(), array( &$this, 'add_settings_page_link' ) );
	}

	/**
	 * Add settings link to plugin list table
	 * @param  array $links Existing links
	 * @return array 		Modified links
	 */
	public
	function add_settings_page_link(
		$links
	) {
		$settings_link =
			'<a href="'
			. $this->get_page_url()
			. '"'
			. ' title="' . esc_attr__( 'Settings' )	. '"'
			. ' class="settings"'
			. '>'
			. __( 'Settings' )
			. '</a>'
		;
		array_push( $links, $settings_link );
		return $links;
	}

	public
	function get_page_title() {
		return $this->plugin->get_title( false );
	}

	public
	function get_page_slug() {
		return $this->plugin->get_slug();
	}

	protected
	function do_add_submenu_page() {
		\add_submenu_page(
			$this->get_parent_slug()
			, $this->get_page_title()
			, $this->get_menu_title()
			, $this->get_capability()
			, $this->get_page_slug()
			, array( &$this, 'display' )
		);
	}

	public
	function display() {
		$_template_file = \WPF\v1\GUI\locate_template( 'settings_page.php' );
		require( $_template_file );
	}

}
?>