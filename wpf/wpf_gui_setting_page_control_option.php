<?php 

namespace WPF\v1\GUI\Setting\Page\Control;

require_once ( 'wpf_inc.php' );
require_once ( 'wpf_gui_setting_page_control_base.php' );
require_once ( 'wpf_gui_templates.php' );

/*
Control base class for options related controls (for settings page).

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
abstract
class Option
	extends
		Base
{

	protected
	$option_id;
	
	public
	function __construct(
		$option_id
	) {
		$this->option_id = $option_id;
	}

	public
	function get_id() {
		return $this->option_id;
	}

	public
	function get_option_id() {
		return $this->option_id;
	}

	public
	function get_option_name() {
		return 'test-name';
	}

	public
	function get_label() {
		return 'test label';
	}

	public
	function get_option_value() {
		return 'test value';
	}

}
?>