<?php 

namespace WPF\v1\GUI\Setting\Page;

require_once ( 'wpf_inc.php' );
require_once ( 'wpf_gui_setting_page_ibase.php' );
require_once ( 'wpf_plugin_component_base.php' );

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

	public
	function __construct(
	) {
	}

	public
	function bind_action_handlers_and_filters() {
		$this->check_bind();
		\add_action( 'admin_menu', array( &$this, 'add_settings_page' ) ); 
	}

	public
	function get_page_title() {
		return 'page_title';
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
	function get_page_slug() {
		return 'menu_slug';
	}

	public
	function add_settings_page() {
		\add_options_page(
			$this->get_page_title()
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