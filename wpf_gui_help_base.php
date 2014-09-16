<?php

namespace WPF\v1\GUI\Help;

require_once ( 'wpf_gui_help_ibase.php' );
require_once ( 'wpf_gui_component_base.php' );

/*
Base class for pluggable help components.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
abstract
class Base
	extends
		\WPF\v1\GUI\Component\Base
	implements
		\WPF\v1\GUI\Help\IBase
		, \WPF\v1\GUI\Component\IBase
{

	public
	function on_page_load() {
		add_action( 'admin_head', array( &$this, 'add_help' ) );
	}

	abstract
	public
	function add_help();

}
?>