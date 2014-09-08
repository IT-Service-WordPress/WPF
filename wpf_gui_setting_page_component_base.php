<?php 

namespace WPF\v1\GUI\Setting\Page\Component;

require_once ( 'wpf_gui_setting_page_component_ibase.php' );
require_once ( 'wpf_plugin_component_base.php' );
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
	extends
		\WPF\v1\Plugin\Component\Base
	implements
		IBase
{

	protected
	// \WPF\v1\GUI\Setting\Page\IBase&
	$page;

	public
	function __construct( 
	) {
		parent::__construct();
	}

	public
	function bind_action_handlers_and_filters() {
	}

	public
	function bind_to_page(
		\WPF\v1\GUI\Setting\Page\IBase& $page
	) {
		$this->page = $page;
	}

	protected
	function check_page_bind() {
		$this->check_bind();
		if ( is_null( $this->page ) ) {
			\WPF\v1\trigger_wpf_error(
				sprintf(
					__( 'Plugin "%1$s" coding error: component <code>%2$s</code> must be associated with an instance of settings page, not with the instance of the plugin directly.', \WPF\v1\WPF_ADMINTEXTDOMAIN )
					, $this->plugin->get_title()
					, \get_class( $this )
				)
				, E_USER_NOTICE
			);
		};
	}
	
	public
	function on_page_load() {
	}

}
?>