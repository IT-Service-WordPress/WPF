<?php 

namespace WPF\v1\GUI\Setting\Page\Component\Help;

require_once ( 'wpf_inc.php' );
require_once ( 'wpf_gui_setting_page_component_base.php' );
require_once ( 'wpf_gui_setting_page_component_help_ibase.php' );
require_once ( 'wpf_gui_setting_page_component_help_itab.php' );
require_once ( 'wpf_gui_setting_page_component_help_tab.php' );

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
	$tabs;
	
	public
	function add_tabs(
		// ITab
		$tabs
	) {
		$tab = $tabs;
		if ( is_array( $tabs ) || ( $tabs instanceof \Traversable ) ) {
			foreach ( $tabs as $tab ) {
				$this->add_tabs( $tab );
			};
		} elseif ( $tab instanceof ITab ) {
			$this->tabs[] = $tab;
			$tab->bind_to_help( $this );
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
						, get_class( $tab )
						, '\WPF\v1\GUI\Setting\Page\Component\Help\ITab'
					)
					, 'error'
				);
			};
		};
	}

	public
	function __construct(
		// произвольное количество ITab
	) {
		parent::__construct();
		$this->tabs = array();
		$this->add_tabs(
			func_get_args()
		);
	}
	
	public
	function on_page_load() {
		foreach ( $this->tabs as $tab ) {
			$tab->add_help_tab();
		};
	}

}
?>