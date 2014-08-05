<?php 

require_once ( 'wpf_inc.php' );
require_once ( 'wpf_admin_notice.php' );

/*
IWPF_Compatibility_Validator interface. Software compatibility requirements validators base class.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
interface IWPF_Compatibility_Validator {

	public
	function validate();
	
}
?>