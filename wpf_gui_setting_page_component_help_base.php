<?php 

namespace WPF\v1\GUI\Setting\Page\Component\Help;

require_once ( 'wpf_gui_setting_page_component_base.php' );
require_once ( 'wpf_gui_setting_page_component_help_ibase.php' );
require_once ( 'wpf_gui_setting_page_component_help_itab.php' );

/*
Settings page pluggable help component class.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class Base
	extends
		\WPF\v1\GUI\Setting\Page\Component\Base
	implements
		IBase
{

	protected
	$components;
	
	public
	function add_components(
		// IComponent
		$components
	) {
		$component = $components;
		if ( is_array( $components ) || ( $components instanceof \Traversable ) ) {
			foreach ( $components as $component ) {
				$this->add_components( $component );
			};
		} elseif ( $component instanceof IComponent ) {
			$this->components[] = $component;
		} else { // unsupported component
			if ( 
				\WP_DEBUG
				&& \is_admin()
			) {
				require_once( 'wpf_gui_notice_admin.php' );
				new \WPF\v1\GUI\Notice\Admin(
					sprintf(
						__( 'Plugin coding error: class <code>%2$s</code> doesn`t support component <code>%3$s</code>. Components must implement <code>%4$s</code> interface.', \WPF\v1\WPF_ADMINTEXTDOMAIN )
						, '' // $this->plugin->get_title()
						, get_class( $this )
						, get_class( $component )
						, '\WPF\v1\GUI\Setting\Page\Component\Help\IComponent'
					)
					, 'error'
				);
			};
		};
	}

	public
	function __construct(
		// произвольное количество IComponent
	) {
		parent::__construct();
		$this->components = array();
		$this->add_components(
			func_get_args()
		);
	}

	public
	function bind(
		\WPF\v1\Plugin\IBase& $plugin
	) {
		parent::bind( $plugin );
		foreach ( $this->components as $component ) {
			$component->bind_to_help( $this );
		};
	}

	public
	function on_page_load() {
		foreach ( $this->components as $component ) {
			$component->add_help();
		};
	}

}
?>