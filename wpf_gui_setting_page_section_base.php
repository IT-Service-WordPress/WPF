<?php

namespace WPF\v1\GUI\Setting\Page\Section;

require_once ( 'wpf_gui_setting_page_ibase.php' );
require_once ( 'wpf_gui_setting_page_section_ibase.php' );
require_once ( 'wpf_gui_component_ibase.php' );
require_once ( 'wpf_gui_component_base.php' );
require_once ( 'wpf_gui_group_ibase.php' );
require_once ( 'wpf_gui_group_base.php' );

/*
Settings page section descriptor base class.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class Base
	extends
		\WPF\v1\GUI\Component\Base
	implements
		IBase
		// , \WPF\v1\GUI\Group\IBase
{
	use \WPF\v1\GUI\Group\Base;

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
		$this->id = $id;
		$this->title = $title;

		$this->_init_components();
		$this->add_components(
			array_slice( func_get_args(), 2 )
		);
	}

	public
	// \WPF\v1\Plugin\IBase&
	function get_plugin() {
		return $this->get_group()->get_plugin();
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
	function display() {
	}

}
?>