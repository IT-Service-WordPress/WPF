<?php 

namespace WPF\v1\GUI\Setting\Page\Component\Help;

require_once ( 'wpf_gui_setting_page_component_help_itab.php' );
require_once ( 'wpf_gui_templates.php' );

/*
Settings page pluggable help component for including plugin header data into help.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class PluginData
	implements
		IComponent
{

	public
	function __construct() {
	}
	
	protected
	// \WPF\v1\Plugin\IBase&
	$plugin;

	public
	function bind_to_help(
		IBase& $help
	) {
		$this->plugin = $help->get_plugin();
	}

	public
	function add_help() {
		$screen = \get_current_screen();

		$_template_file = \WPF\v1\GUI\locate_template( 'plugin_help_overview.php' );
		ob_start();
		require( $_template_file );
		$screen->add_help_tab( array(
			'id'      => 'overview',
			'title'   => __( 'Overview' ),
			'content' => ob_get_clean()
		) );

		$_template_file = \WPF\v1\GUI\locate_template( 'plugin_help_sidebar.php' );
		ob_start();
		require( $_template_file );
		$screen->set_help_sidebar(
			ob_get_clean()
		);
	}

}
?>