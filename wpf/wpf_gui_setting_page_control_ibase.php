<?php 

namespace WPF\v1\GUI\Setting\Page\Control;

require_once ( 'wpf_inc.php' );

/*
Settings page control interface.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
interface IBase
{

	public
	function get_id();

	public
	function get_label();

	public
	function display();

}
?>