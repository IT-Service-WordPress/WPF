<?php 

namespace WPF\v1\GUI\Setting\Page\Control;

require_once ( 'wpf_inc.php' );
require_once ( 'wpf_gui_setting_page_ibase.php' );
require_once ( 'wpf_gui_setting_page_section_ibase.php' );

/*
Settings page control base class.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
abstract
class Base
	implements
		IBase
{

	protected
	$id;

	protected
	$option_name;

	protected
	$title;

	protected
	$description;

	protected
	// \WPF\v1\GUI\Setting\Page\Section\IBase&
	$section;

	public
	function __construct(
		$id
		, $option_name = null
		, $title = null
		, $description = null
	) {
		$this->id = $id;
		$this->option_name = $option_name ? $option_name : $id;
		$this->title = $title ? $title : $this->option_name;
		$this->description = $description;
	}

	public
	function bind_to_page_section(
		\WPF\v1\GUI\Setting\Page\Section\IBase& $section
	) {
		$this->section = $section;
	}

	public
	function get_id() {
		return $this->id;
	}

	public
	function get_option_name() {
		return $this->option_name;
	}

	public
	function get_label() {
		return $this->title;
	}

	public
	function get_description() {
		return $this->description;
	}

	public
	function get_option_value() {
		return \get_option( $this->get_option_name() );
	}

	public
	function add_settings_field() {
		\add_settings_field(
			$this->get_id()
			, $this->get_label()
			, array( &$this, 'display' )
			, $this->section->get_page_slug()
			, $this->section->get_id()
			, array( 'label_for' => $this->get_id() )
		);
	}

}
?>