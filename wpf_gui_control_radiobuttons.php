<?php

namespace WPF\v1\GUI\Control;

require_once ( 'wpf_gui_control_base.php' );
require_once ( 'wpf_gui_templates.php' );

/*
Radio buttons control class.

@since 1.1.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class RadioButtons
	extends
		Base
{

	protected
	$choices;

	public
	function display() {
		$_template_file = \WPF\v1\GUI\locate_template( 'settings_page-radiobuttons.php' );
		require( $_template_file );
	}

}
?>