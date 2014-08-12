<?php 

namespace WPF\v1\GUI\Setting\Page;

require_once ( 'wpf_inc.php' );
require_once ( 'wpf_gui_setting_page_base.php' );
require_once ( 'wpf_gui_notice_admin.php' );

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
			func_get_args()
		);
	}

	public
	function bind_action_handlers_and_filters() {
		parent::bind_action_handlers_and_filters();
		\add_action( 'pre_current_active_plugins', array( &$this, '_add_settings_page_link' ) ); 

		\add_action( 'after_install_' . $this->plugin->get_basename(), array( &$this, 'schedule_review_settings_notice' ) ); 
		\add_action( 'after_update_' . $this->plugin->get_basename(), array( &$this, 'schedule_review_settings_notice' ) ); 
		// \add_action( 'after_activate_' . $this->plugin->get_basename(), array( &$this, 'schedule_review_settings_notice' ) ); // just for test

		\add_action( 'after_set_opts_' . $this->plugin->get_basename(), array( &$this, 'add_review_settings_notice' ) ); 

		\add_action( 'admin_init', array( &$this, 'run_deffered_actions' ), 999 );
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
	function run_deffered_actions() {
		$this->plugin->run_deffered_actions( 'set_opts' );
	}

	public
	function schedule_review_settings_notice() {
		$this->plugin->schedule_deffered_action( 'set_opts', true, 24 * HOUR_IN_SECONDS );
	}

	public
	function add_review_settings_notice() {
		add_action( 'load-plugins.php', array( &$this, 'display_review_settings_notice' ) ); 
		add_action( 'load-options-general.php', array( &$this, 'display_review_settings_notice' ) ); 
		add_action( 'load-update-core.php', array( &$this, 'display_review_settings_notice' ) ); 
		add_action( 'load-index.php', array( &$this, 'display_review_settings_notice' ) ); 
	}

	public
	function display_review_settings_notice() {
		if (
			\current_user_can( 'manage_options' )
		) {
			new \WPF\v1\GUI\Notice\Admin(
				sprintf(
					__( '<a href="%2$s">Review plugin "%1$s" settings</a>. Plugin was installed or updated.', \WPF\v1\WPF_ADMINTEXTDOMAIN )
					, $this->plugin->get_title( false )
					, $this->get_page_url()
				)
				, 'updated'
			);
		};
	}

	public
	function on_page_load() {
		parent::on_page_load();
		$this->plugin->reset_deffered_action( 'set_opts' );
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

}
?>