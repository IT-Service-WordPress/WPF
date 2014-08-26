<?php 

namespace WPF\v1\Plugin\Part;

require_once ( 'wpf_plugin_part_ibase.php' );
require_once ( 'wpf_plugin_ibase.php' );
require_once ( 'wpf_plugin_component_base.php' );

/*
Plugin part container (admin-side, frontend, so on).

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class Base
	extends
		\WPF\v1\Plugin\Component\Base
	implements
		IBase
		, \WPF\v1\Plugin\Component\IBase
{

	protected
	// \WPF\v1\Plugin\Component\Collection
	$components;

	public
	function __construct (
		/* \WPF\v1\Plugin\Component\IBase& */ $components // неопределённое количество компонентов больше одного
	) {
		parent::__construct();

		$this->components = new \WPF\v1\Plugin\Component\Collection(
			func_get_args()
		);
		
		if ( $plugin = \WPF\v1\Plugin\Part\Load\Base::get_plugin_instance() ) {
			$this->bind( $plugin );
			$this->bind_action_handlers_and_filters( $plugin );
		};
	}

	public
	function bind(
		\WPF\v1\Plugin\IBase& $plugin
	) {
		parent::bind( $plugin );
		$this->plugin->add_components( $this->components );
	}

	public
	function bind_action_handlers_and_filters() {
	}

}
?>