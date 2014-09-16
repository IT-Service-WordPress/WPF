<?php

namespace WPF\v1\GUI\Help;

require_once ( 'wpf_gui_component_base.php' );
require_once ( 'wpf_gui_group_base.php' );
require_once ( 'wpf_gui_help_plugintab.php' );
require_once ( 'wpf_gui_help_pluginsidebar.php' );

/*
Settings page pluggable help component for including plugin header data into help.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/

class PluginData
	extends
		\WPF\v1\GUI\Component\Base
	implements
		\WPF\v1\GUI\Component\IBase
		, \WPF\v1\GUI\Group\IBase
{
	use \WPF\v1\GUI\Group\Base;

	public
	function __construct() {
		parent::__construct();
		$this->_init_components();
		$this->add_components( array (
			new \WPF\v1\GUI\Help\PluginTab()
			, new \WPF\v1\GUI\Help\PluginSidebar()
		) );
	}

}
?>