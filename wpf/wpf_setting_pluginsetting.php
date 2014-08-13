<?php 

namespace WPF\v1\Setting;

require_once ( 'wpf_inc.php' );
require_once ( 'wpf_setting_base.php' );

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
		Base
{

	public
	function __construct(
		$id // option name without plugin prefix
		, $value = null
		, $autoload = true
	) {
		parent::__construct(
			$id
			, $value
			, $autoload
		);
	}
	
	public
	function bind_action_handlers_and_filters() {
		parent::bind_action_handlers_and_filters();
		// \add_action( 'admin_init', array( &$this, 'register_setting' ) );
	}

	public
	function register_setting() {
		\register_setting(
			'my_options_group'
			, 'my_option_name'
			, 'intval'
		);
	}

}
?>