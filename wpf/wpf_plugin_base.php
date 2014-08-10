<?php 

namespace WPF\v1\Plugin;

require_once ( 'wpf_inc.php' );
require_once ( 'wpf_plugin_ibase.php' );
require_once ( 'wpf_plugin_component_ibase.php' );
require_once ( 'wpf_plugin_component_collection.php' );

/*

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class Base
	implements
		IBase
{

	protected
	$_file; // __FILE__;

	final
	public
	function get_file() {
		return $this->_file;
	}
	
	protected
	$base_name; // __FILE__;

	final
	public
	function get_basename() {
		return $this->base_name;
	}
	
	protected
	$_slug; // dirname( plugin_basename( __FILE__ ) );

	public
	function get_slug() {
		return $this->_slug;
	}

	protected
	$_namespace; // dirname( plugin_basename( __FILE__ ) );

	public
	function get_namespace() {
		return $this->_namespace;
	}

	final
	public
	function get_dir_path() {
		return \plugin_dir_path( $this->_file );
	}

	final
	public
	function get_dir_url() {
		return \plugin_dir_url( $this->_file );
	}
	
	final
	public
	function get_file_url(
		$path // Path to the plugin file of which URL you want to retrieve, relative to the plugin
	) {
		return \plugins_url( $path, $this->_file );
	}
	
	final
	public
	function get_file_path(
		$path // Path to the plugin file of which URL you want to retrieve, relative to the plugin
	) {
		return $this->get_dir_path() . $path;
	}
	
	private
	$_data;

	private
	function load_data() {
		if ( is_null( $this->_data ) ) {
			$this->_data = array();
			$this->_data[ false ] = \get_plugin_data( $this->_file, false, true );
			$this->_data[ true ] = \_get_plugin_data_markup_translate( $this->_file, $this->_data[ false ], true, false );
		};
	}
	
	public
	function get_title(
		$markup = true
	) {
		$this->load_data();
		return $this->_data[ $markup ][ 'Title' ];
	}
	
	public
	function get_plugin_uri() {
		$this->load_data();
		return $this->_data[ false ][ 'PluginURI' ];
	}
	
	public
	function get_version() {
		$this->load_data();
		return $this->_data[ false ][ 'Version' ];
	}
	
	public
	function get_description(
		$markup = true
	) {
		$this->load_data();
		return $this->_data[ $markup ][ 'Description' ];
	}
	
	public
	function get_author_name(
		$markup = true
	) {
		$this->load_data();
		return $this->_data[ $markup ][ 'AuthorName' ];
	}
	
	public
	function get_author_uri() {
		$this->load_data();
		return $this->_data[ false ][ 'AuthorURI' ];
	}

	public
	function get_network_support() {
		$this->load_data();
		return $this->_data[ false ][ 'Network' ];
	}
	
	protected
	// \WPF\v1\Plugin\Component\Collection
	$components;
	
	public
	function add_components(
		/* Component\IBase& */ $components // неопределённое количество компонентов больше одного
	) {
		if ( is_array( $components ) || ( $components instanceof \Traversable ) ) {
			foreach ( $components as $component ) {
				$this->add_components( $component );
			};
		} else {
			$this->components->add( $components );
			$components->bind( $this );
			$components->bind_action_handlers_and_filters();
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

	final
	public
	function register_activation_hook(
		$function
	) {
		return \register_activation_hook(
			$this->get_file()
			, $function
		);
	}

	final
	public
	function register_deactivation_hook(
		$function
	) {
		return \register_deactivation_hook(
			$this->get_file()
			, $function
		);
	}

	final
	public
	function register_uninstall_hook(
		$function
	) {
		return \register_uninstall_hook(
			$this->get_file()
			, $function
		);
	}

	final
	public
	function activate() {
	}

	final
	public
	function deactivate() {
		if ( current_user_can( 'activate_plugins' ) ) {
			\deactivate_plugins( $this->get_file() );
			if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] ); 
			new \WPF\v1\GUI\Notice\Admin(
				\sprintf(
					__( 'Plugin <strong>deactivated</strong>.' )
					, $this->get_title()
				)
				, 'error'
			);
		};
	}
	
	public
	function get_plugin_load_action_name() {
		return 'load_' . $this->get_basename();
	}

	public
	function __construct( 
		$plugin_file
		, /* Component\IBase& */ $components // неопределённое количество компонентов больше одного
	) {
		$this->_file = $plugin_file;
		$this->base_name = plugin_basename( $this->_file );
		$this->_namespace = dirname( plugin_basename( $this->_file ) );
		$this->_slug = \sanitize_title( $this->_namespace );
		$basename = basename( $this->_file, '.php' );
		if ( 'main' != $basename ) {
			$this->_slug += '_' . $basename;
		};

		$this->components = new Component\Collection();
		$this->add_components(
			array_slice( func_get_args(), 1 )
		);

		do_action( $this->get_plugin_load_action_name() );
	}

	private
	function __clone() {}

    private
	function __sleep() {}

    private
	function __wakeup() {}
}
?>