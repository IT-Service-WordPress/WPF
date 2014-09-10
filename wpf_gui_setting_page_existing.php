<?php

namespace WPF\v1\GUI\Setting\Page;

require_once ( 'wpf_gui_setting_page_base.php' );

/*
Settings page descriptor class.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class Existing
	extends
		Base
{

	protected
	$parent_slug;

	protected
	$page_slug;

	public
	function __construct(
		$parent_slug
		, $page_slug
		, $sections // произвольное количество ISection или string. В случае строк - строки являются идентификаторами отдельно загружаемых секций.
	) {
		$this->parent_slug = $parent_slug;
		$this->page_slug = $page_slug;
		parent::__construct(
			array_slice( func_get_args(), 2 )
		);
	}

	public
	function get_parent_slug() {
		return $this->parent_slug;
	}

	public
	function get_page_slug() {
		return $this->page_slug;
	}
	
!!!!!		public
	function get_option_group() {
		return $this->plugin->get_namespace();
	}



}
?>