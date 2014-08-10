<?php 

namespace WPF\v1\GUI\Setting\Page;

require_once ( 'wpf_inc.php' );
require_once ( 'wpf_gui_setting_page_base.php' );

/*
Plugin settings page descriptor base class.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class PluginOptions
	extends
		Base
{

	public
	function __construct(
	) {
		parent::__construct();
	}

	public
	function get_page_title() {
		return $this->plugin->get_title( false );
	}

	public
	function get_page_slug() {
		return $this->plugin->get_slug();
	}

}
?>