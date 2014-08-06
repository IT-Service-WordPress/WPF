<?php 

namespace WPF\v1\Compatibility;

require_once ( 'wpf_inc.php' );
require_once ( 'wpf_gui_notice_admin.php' );

/*
Software compatibility requirements validators base class.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
interface IBase {

	public
	function validate();
	
}
?>