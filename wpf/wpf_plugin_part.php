<?php 

namespace WPF\v1;

require_once ( 'wpf_inc.php' );
require_once ( 'iwpf_plugin_part.php' );
require_once ( 'iwpf_plugin.php' );
require_once ( 'wpf_plugin_component.php' );

/*
WPF_Plugin_Part class. Plugin part container (admin-side, frontend, so on).

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class WPF_Plugin_Part
	extends
		WPF_Plugin_Component
	implements
		IWPF_Plugin_Part
		, IWPF_Plugin_Component
{

	protected
	// WPF_Plugin_Components_Collection
	$components;

	public
	function __construct (
		/* IWPF_Plugin_Component& */ $components // неопределённое количество компонентов больше одного
	) {
		parent::__construct();

		$this->components = new WPF_Plugin_Components_Collection(
			func_get_args()
		);
		
		if ( $plugin = WPF_Plugin_Part_Load::get_plugin_instance() ) {
			$this->bind( $plugin );
			$this->bind_action_handlers_and_filters( $plugin );
		} else {
			// !!!! throw error !!!! or not? (for use parts in plugin constructor)
		};
	}

	public
	function bind(
		IWPF_Plugin& $plugin
	) {
		parent::bind( $plugin );
		foreach ( $this->components as $component ) {
			$component->bind( $this->plugin );
		};
	}

	public
	function bind_action_handlers_and_filters() {
		$this->check_bind();
		foreach ( $this->components as $component ) {
			$component->bind_action_handlers_and_filters();
		};
	}

}
?>