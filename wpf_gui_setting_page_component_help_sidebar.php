<?php 

namespace WPF\v1\GUI\Setting\Page\Component\Help;

require_once ( 'wpf_inc.php' );
require_once ( 'wpf_gui_setting_page_component_help_icomponent.php' );

/*
Settings page pluggable help "sidebar" component class.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class Sidebar
	implements
		IComponent
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
	function bind_to_help(
		IBase& $help
	) {
	}

	public
	function get_content() {
		return $this->content;
	}

	public
	function add_help() {
		$screen = \get_current_screen();
		$screen->set_help_sidebar( $this->get_content() );
	}

}
?>