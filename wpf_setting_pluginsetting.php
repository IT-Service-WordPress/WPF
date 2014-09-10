<?php

namespace WPF\v1\Setting;

\_deprecated_file( __FILE__, '1.1' ); // https://github.com/IT-Service-WordPress/WPF/issues/48

require_once ( 'wpf_setting_serializable.php' );

/*
Plugin setting descriptor class.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class PluginSetting
	extends
		Serializable
{

	public
	function __construct(
		$option_name
		, $default_value = null
		, $autoload = true
		, $sanitize_callback = null
	) {
		parent::__construct(
			''
			, $option_name
			, $default_value
			, $autoload
			, $sanitize_callback
		);
	}

	public
	function get_option_group() {
		return $this->plugin->get_namespace();
	}

}
?>