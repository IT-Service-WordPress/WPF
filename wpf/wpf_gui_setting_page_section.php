<?php 

namespace WPF\v1\GUI\Setting\Page;

require_once ( 'wpf_inc.php' );
require_once ( 'wpf_gui_setting_page_ibase.php' );
require_once ( 'wpf_gui_setting_page_isection.php' );
require_once ( 'wpf_plugin_component_base.php' );

/*
Settings page section descriptor base class.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class Section
	extends
		\WPF\v1\Plugin\Component\Base
	implements
		ISection
{

	protected
	// IBase&
	$page;

	protected
	$id;

	protected
	$title;

	public
	function __construct(
		$id
		, $title
		// произвольное количество визуальных элементов
	) {
		parent::__construct();
		$this->page = null;
		$this->id = $id;
		$this->title = $title;
	}

	public
	function bind_action_handlers_and_filters() {
	}
	
	public
	function bind_to_page(
		IBase& $page
	) {
		$this->page = $page;
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
	function get_page_slug() {
		return $this->page->get_page_slug();
	}

	public
	function add_settings_section() {
		\add_settings_section(
			$this->get_id()
			, $this->get_title()
			, array( &$this, 'display' )
			, $this->get_page_slug()
		);
	}

	public
	function display() {
		//$_template_file = \WPF\v1\GUI\locate_template( 'settings_page.php' );
		//require( $_template_file );
		echo 'test---------------------';
	}

}
?>