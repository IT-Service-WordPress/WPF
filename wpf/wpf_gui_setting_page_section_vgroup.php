<?php 

namespace WPF\v1\GUI\Setting\Page\Section;

require_once ( 'wpf_inc.php' );
require_once ( 'wpf_gui_setting_page_section_base.php' );

/*
Settings page section with table design descriptor class.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class VGroup
	extends
		Base
{

	public
	function display() {
		$_template_file = \WPF\v1\GUI\locate_template( 'settings_page-section-vgroup.php' );
		require( $_template_file );
	}

}
?>