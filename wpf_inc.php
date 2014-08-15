<?php 
/*
Wordpress Plugin framework common header file.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/

namespace WPF\v1;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

const WPF_DIR = __DIR__;
const WPF_TEXTDOMAIN = 'wpf';
const WPF_ADMINTEXTDOMAIN = 'wpf-admin';

?>