<?php 

namespace WPF\v1\GUI\Setting\Page;

require_once ( 'wpf_gui_setting_page_ibase.php' );
require_once ( 'wpf_gui_setting_page_section_ibase.php' );
require_once ( 'wpf_plugin_component_base.php' );

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
	$components;
	
	public
	function add_components(
		// произвольное количество ISection, string или Component\IBase. В случае строк - строки являются идентификаторами отдельно загружаемых секций.
		$components
	) {
		$component = $components;
		if ( is_array( $components ) || ( $components instanceof \Traversable ) ) {
			foreach ( $components as $component ) {
				$this->add_components( $component );
			};
		} elseif ( $component instanceof Section\IBase ) {
			$this->components[ $component->get_id() ] = $component;
			$component->bind_to_page( $this );
		} elseif ( $component instanceof Component\IBase ) {
			$this->components[] = $component;
			$component->bind_to_page( $this );
		} elseif ( is_string( $component ) ) {
			$this->components[ $component ] = true;
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
						, '\WPF\v1\GUI\Setting\Page\Component\IBase'
					)
					, 'error'
				);
			};
		};
	}

	public
	function get_components(
		$component_type = null // interface id, or null for all components
	) {
		if ( $component_type ) {
			$found = array();
			foreach ( $this->components as $component ) {
				if ( $component instanceof $component_type ) {
					$found[] = $component;
				};
			};
			return $found;
		} else {
			return $this->components;
		};
	}

	public
	function has_component(
		$component_type // interface id
	) {
		$found = false;
		foreach ( $this->components as $component ) {
			if ( $component instanceof $component_type ) {
				$found = true;
				break;
			};
		};
		return $found;
	}

	public
	function get_sections() {
		return $this->get_components( '\WPF\v1\GUI\Setting\Page\Section\IBase' );
	}

	public
	function bind_external_sections() {
		$plugin_sections = $this->plugin->get_components( '\WPF\v1\GUI\Setting\Page\Section\IBase' );
		foreach ( $plugin_sections as $section ) {
			if (
				array_key_exists( $section->get_id(), $this->components )
				&& ( true === $this->components[ $section->get_id() ] )
			) { // it's no object now
				$this->components[ $section->get_id() ] = $section;
				$section->bind_to_page( $this );
			};
		};
		if ( 
			\WP_DEBUG
			&& \is_admin()
		) {
			foreach ( $this->components as $section_id => $section ) {
				if ( true === $section ) { // it's no object now
					require_once( 'wpf_gui_notice_admin.php' );
					new \WPF\v1\GUI\Notice\Admin(
						sprintf(
							__( 'Plugin "%1$s" coding error: settings page <code>%2$s</code> requires <code>%3$s</code> settings section, but specified section doesn`t exists.', \WPF\v1\WPF_ADMINTEXTDOMAIN )
							, $this->plugin->get_title()
							, $this->get_page_slug()
							, $section_id
						)
						, 'error'
					);
				};
			};
		};
	}

	public
	function __construct(
		// произвольное количество ISection или string. В случае строк - строки являются идентификаторами отдельно загружаемых секций.
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
		foreach ( $this->components as $section_id => $section ) {
			if ( $section instanceof \WPF\v1\Plugin\Component\IBase ) {
				$this->plugin->add_components( $section );
			};
		};
	}

	public
	function bind_action_handlers_and_filters() {
		$this->check_bind();
		\add_action( 'init', array( &$this, 'bind_external_sections' ) );
		\add_action( 'admin_menu', array( &$this, 'add_submenu_page' ) );
		// !!! network !!!
	}

	public
	function get_option_group() {
		return $this->plugin->get_namespace();
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
	function get_page_hookname() {
		return get_plugin_page_hookname(
			$this->get_page_slug()
			, $this->get_parent_slug()
		);
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
		foreach ( $this->get_sections() as $section ) {
			$section->add_settings_section();
		};
		\add_action( 'load-' . $page_load_action, array( &$this, 'on_page_load' ) );
	}

	public
	function display() {
		$_template_file = \WPF\v1\GUI\locate_template( 'settings_page.php' );
		require( $_template_file );
	}

	public
	function on_page_load() {
		foreach ( $this->components as $component ) {
			$component->on_page_load();
		};
	}

}
?>