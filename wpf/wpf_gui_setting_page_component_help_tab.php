<?php 

namespace WPF\v1\GUI\Setting\Page\Component\Help;

require_once ( 'wpf_inc.php' );
require_once ( 'wpf_gui_setting_page_component_help_itab.php' );

/*
Settings page pluggable help "tab" component class.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class Tab
	implements
		ITab
{

	protected
	$id;

	protected
	$title;

	protected
	$content;

	public
	function __construct(
		$id
		, $title
		, $content
	) {
		$this->id = $id;
		$this->title = $title;
		$this->content = $content;
	}
	
	public
	function bind_to_help(
		IBase& $help
	) {
	}

	public
	function get_id() {
		return $this->id;
	}

	public
	function get_title() {
		return $this->title;
	}

	public
	function get_content() {
		return $this->content;
	}

	public
	function add_help() {
		$screen = \get_current_screen();
		$screen->add_help_tab( array( 
		   'id' => $this->get_id()
		   , 'title' => $this->get_title()
		   , 'content' => $this->get_content()
		   // , 'callback' => array( &$this, 'func' )
		) );
	}

}
?>