<?php

namespace WPF\v1\GUI\Component;

require_once ( 'wpf_gui_component_ibase.php' );
require_once ( 'wpf_functions.php' );

/*
Settings page pluggable component base class.

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
	// \WPF\v1\GUI\Group\IBase&
	$group;

	public
	function __construct(
	) {
	}

	public
	function bind_action_handlers_and_filters() {
	}

	public
	function bind_group(
		\WPF\v1\GUI\Group\IBase& $group
	) {
		$this->group = $group;
		$this->after_bind();
	}

	protected
	function after_bind() {
	}

	public
	// \WPF\v1\GUI\Group\IBase&
	function get_group() {
		return $this->group;
	}

	public
	function on_page_load() {
	}

}
?>