<?php

namespace WPF\v1\GUI\Help;

require_once ( 'wpf_gui_help_tab.php' );
require_once ( 'wpf_gui_templates.php' );

/*
@since 1.1.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class PluginTab
	extends
		Tab
{

	public
	function get_id() {
		return 'overview';
	}

	public
	function get_title() {
		return __( 'Overview' );
	}

	public
	function display() {
		$_template_file = \WPF\v1\GUI\locate_template( 'plugin_help_overview.php' );
		require( $_template_file );
	}

}
?>