<?php

namespace WPF\v1\GUI\Help;

require_once ( 'wpf_gui_help_ibase.php' );
require_once ( 'wpf_gui_component_base.php' );
require_once ( 'wpf_gui_templates.php' );
require_once ( 'wpf_plugin_ilink.php' );

/*
Settings page pluggable help component for including plugin header data into help.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class PluginData
	extends
		\WPF\v1\GUI\Component\Base
	implements
		\WPF\v1\GUI\Help\IBase
		, \WPF\v1\GUI\Component\IBase
		, \WPF\v1\Plugin\ILink
{

	public
	function __construct() {
	}

	public
	function get_plugin() {
		return $this->group->get_plugin();
	}

	public
	function on_page_load() {
		$this->add_help();
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