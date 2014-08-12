<?php 

namespace WPF\v1\GUI\Setting\Page;

require_once ( 'wpf_inc.php' );
require_once ( 'wpf_gui_setting_page_ibase.php' );
require_once ( 'wpf_plugin_component_base.php' );
require_once ( 'wpf_collection.php' );

/*
Settings page descriptor base class.

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
	// \WPF\v1\Collection
	$sections;
	
	public
	function add_sections(
		// произвольное количество ISection или string. В случае строк - строки являются идентификаторами отдельно загружаемых секций.
		/* ISection& */ $sections
	) {
		$this->sections->add( $sections );
		/*
		if ( is_array( $components ) || ( $components instanceof \Traversable ) ) {
			foreach ( $components as $component ) {
				$this->add_components( $component );
			};
		} else {
			$this->components->add( $components );
			$components->bind( $this );
			$components->bind_action_handlers_and_filters();
		};
		*/
	}

	public
	function get_sections() {
		return $this->sections;
	}

	public
	function __construct(
		// произвольное количество ISection или string. В случае строк - строки являются идентификаторами отдельно загружаемых секций.
	) {
		$this->sections = new \WPF\v1\Collection();
		$this->add_sections(
			func_get_args()
		);
	}

	public
	function bind_action_handlers_and_filters() {
		$this->check_bind();
		\add_action( 'admin_menu', array( &$this, 'add_submenu_page' ) );
		// !!! network !!!
	}

	public
	function get_parent_slug() {
		return 'options-general.php';
	}

	public
	function get_menu_title() {
		return $this->get_page_title();
	}

	public
	function get_capability() {
		return 'manage_options';
	}
	
	public
	function add_submenu_page() {
		$page_load_action = \add_submenu_page(
			$this->get_parent_slug()
			, $this->get_page_title()
			, $this->get_menu_title()
			, $this->get_capability()
			, $this->get_page_slug()
			, array( &$this, 'display' )
		);
		\add_action( $page_load_action, array( &$this, 'on_page_load' ) );
	}

	public
	function display() {
		$_template_file = \WPF\v1\GUI\locate_template( 'settings_page.php' );
		require( $_template_file );
	}

	public
	function on_page_load() {
	}

}
?>