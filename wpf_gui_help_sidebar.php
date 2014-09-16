<?php

namespace WPF\v1\GUI\Help;

require_once ( 'wpf_gui_help_ibase.php' );
require_once ( 'wpf_gui_component_base.php' );

/*
Settings page pluggable help "sidebar" component class.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class Sidebar
	extends
		\WPF\v1\GUI\Component\Base
	implements
		\WPF\v1\GUI\Help\IBase
		, \WPF\v1\GUI\Component\IBase
{

	protected
	$content;

	public
	function __construct(
		$content
	) {
		$this->content = $content;
	}

	public
	function get_content() {
		return $this->content;
	}

	public
	function on_page_load() {
		$this->add_help();
	}

	public
	function add_help() {
		$screen = \get_current_screen();
		$screen->set_help_sidebar( $this->get_content() );
	}

}
?>