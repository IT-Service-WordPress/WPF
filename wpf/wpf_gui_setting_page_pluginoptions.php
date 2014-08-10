<?php 

namespace WPF\v1\GUI\Setting\Page;

require_once ( 'wpf_inc.php' );
require_once ( 'wpf_gui_setting_page_base.php' );

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
	) {
		parent::__construct();
	}

	public
	function bind_action_handlers_and_filters() {
		parent::bind_action_handlers_and_filters();
		\add_action( 'pre_current_active_plugins', array( &$this, '_add_settings_page_link' ) ); 
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
				. add_query_arg(
					'page'
					, $this->plugin->get_slug()
					, \self_admin_url( 'options-general.php' )
				)
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