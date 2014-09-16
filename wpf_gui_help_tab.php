<?php

namespace WPF\v1\GUI\Help;

require_once ( 'wpf_gui_help_ibase.php' );
require_once ( 'wpf_gui_component_base.php' );
require_once ( 'wpf_gui_templates.php' );

/*
Settings page pluggable help "tab" component class.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class Tab
	extends
		\WPF\v1\GUI\Component\Base
	implements
		\WPF\v1\GUI\Help\IBase
		, \WPF\v1\GUI\Component\IBase
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
	function on_page_load() {
		$this->add_help();
	}

	public
	function add_help() {
		$screen = \get_current_screen();
		$screen->add_help_tab( array(
		   'id' => $this->get_id()
		   , 'title' => $this->get_title()
		   // , 'content' => $this->get_content()
		   , 'callback' => array( &$this, 'display' )
		) );
	}

	public
	function display() {
		$_template_file = \WPF\v1\GUI\locate_template( 'help_tab.php' );
		require( $_template_file );
	}

}
?>