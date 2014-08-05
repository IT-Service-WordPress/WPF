<?php 

require_once ( 'wpf_inc.php' );
require_once ( 'wpf_textdomain_wpf.php' );

/*
Common admin-side objects and prototypes.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/

// $WPF_TextDomain_Admin = new WPF_TextDomain( WPF_TEXTDOMAIN );
$WPF_TextDomain_Admin = new WPF_TextDomain_WPF( WPF_ADMINTEXTDOMAIN ); 

?>