<?php 

namespace WPF\v1\GUI\Setting\Page\Control;

require_once ( 'wpf_gui_setting_page_control_base.php' );
require_once ( 'wpf_gui_templates.php' );

/*
Checkbox control class (for settings page).

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class Checkbox
	extends
		Base
{

	public
	function display() {
		$_template_file = \WPF\v1\GUI\locate_template( 'settings_page-checkbox.php' );
		require( $_template_file );
	}

}
?>