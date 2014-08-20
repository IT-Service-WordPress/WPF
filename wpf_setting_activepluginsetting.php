<?php 

namespace WPF\v1\Setting;

require_once ( 'wpf_inc.php' );
require_once ( 'wpf_setting_pluginsetting.php' );

/*
Plugin setting class. Remove option from database on plugin deactivation.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class ActivePluginSetting
	extends
		PluginSetting
{

	public
	function activate() {
		$this->add_option();
	}

	public
	function deactivate() {
		$this->delete_option();
	}

}
?>