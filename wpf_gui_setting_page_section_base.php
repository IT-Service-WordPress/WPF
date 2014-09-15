<?php

namespace WPF\v1\GUI\Setting\Page\Section;

require_once ( 'wpf_gui_setting_page_ibase.php' );
require_once ( 'wpf_gui_setting_page_section_ibase.php' );
require_once ( 'wpf_plugin_component_base.php' );
require_once ( 'wpf_gui_setting_page_component_base.php' );
require_once ( 'wpf_gui_control_ibase.php' );

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
		\WPF\v1\GUI\Setting\Page\Component\Base
	implements
		IBase
{

	protected
	$id;

	protected
	$title;

	protected
	// \WPF\v1\GUI\Control\IBase&[]
	$controls;

	public
	function add_controls(
		// произвольное количество \WPF\v1\GUI\Control\IBase&.
		$controls
	) {
		$control = $controls;
		if ( is_array( $controls ) || ( $controls instanceof \Traversable ) ) {
			foreach ( $controls as $control ) {
				$this->add_controls( $control );
			};
		} else {
			$this->add_control( $control );
		};
	}

	protected
	function add_control(
		\WPF\v1\GUI\Control\IBase& $control
	) {
		$this->controls[] = $control;
		$control->bind_action_handlers_and_filters();
	}

	public
	function get_controls() {
		return $this->controls;
	}

	public
	function __construct(
		$id
		, $title
		// произвольное количество визуальных элементов
	) {
		parent::__construct();
		$this->id = $id;
		$this->title = $title;

		$this->controls = array();
		$this->add_controls(
			array_slice( func_get_args(), 2 )
		);
	}

	public
	function bind_action_handlers_and_filters() {
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