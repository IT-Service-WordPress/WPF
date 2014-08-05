<?php 

require_once ( 'wpf_inc.php' );

/*
IWPF_Plugin_Component interface.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
interface IWPF_Plugin_Component {
	function bind( IWPF_Plugin& plugin );
}
?>