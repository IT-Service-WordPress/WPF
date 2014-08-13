<?php 

namespace WPF\v1\GUI\Setting\Page\Control;

require_once ( 'wpf_inc.php' );
require_once ( 'wpf_gui_setting_page_ibase.php' );
require_once ( 'wpf_gui_setting_page_isection.php' );

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

	public
	function __construct(
		$id = ''
	) {
		$this->id = $id;
	}

	public
	function get_id() {
		return $this->id;
	}

	public
	function get_label() {
		return '';
	}

}
?>