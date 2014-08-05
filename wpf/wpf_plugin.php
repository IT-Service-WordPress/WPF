<?php 

require_once ( 'wpf_inc.php' );
require_once ( 'iwpf_plugin.php' );
require_once ( 'iwpf_plugin_component.php' );

/*
WPF_Plugin class. Just metadata.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class WPF_Plugin
	implements
		IWPF_Plugin
{

	protected
	$_file; // __FILE__;

	final
	public
	function get_file() {
		return $this->_file;
	}
	
	protected
	$_slug; // plugin_basename( __FILE__ ); !!!!

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
		return plugin_dir_path( $this->_file );
	}

	final
	public
	function get_dir_url() {
		return plugin_dir_url( $this->_file );
	}
	
	final
	public
	function get_file_url(
		$path // Path to the plugin file of which URL you want to retrieve, relative to the plugin
	) {
		return plugins_url( $path, $this->_file );
	}
	
	private
	$_data;
	
	private
	function load_data(
		$markup = true
		, $translate = true 
	) {
		if ( is_null( $this->_data ) ) {
			$this->_data = get_plugin_data( $this->_file, $markup, $translate );
		};
	}
	
	public
	function get_title() {
		$this->load_data();
		return $this->_data[ 'Title' ];
	}
	
	public
	function get_plugin_uri() {
		$this->load_data();
		return $this->_data[ 'PluginURI' ];
	}
	
	public
	function get_version() {
		$this->load_data();
		return $this->_data[ 'Version' ];
	}
	
	public
	function get_description() {
		$this->load_data();
		return $this->_data[ 'Description' ];
	}
	
	public
	function get_author_name() {
		$this->load_data();
		return $this->_data[ 'AuthorName' ];
	}
	
	public
	function get_author_uri() {
		$this->load_data();
		return $this->_data[ 'AuthorURI' ];
	}

	public
	function get_network_support() {
		$this->load_data();
		return $this->_data[ 'Network' ];
	}
	
	protected
	// IWPF_Plugin_Component&[]
	$components;

	final
	public
	function add_action(
		$hook
		, $function_to_add
		, $priority = 10
		, $accepted_args = 1
	) {
		return add_action(
			$hook
			, $function_to_add
			, $priority
			, $accepted_args
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
			deactivate_plugins( $this->get_file() );
			if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] ); 
			new WPF_admin_notice(
				sprintf(
					__( 'Plugin <strong>deactivated</strong>.' )
					, $this->get_title()
				)
				, 'error'
			);
		};
	}

	public
	function __construct( 
		$plugin_file
		, /* IWPF_Plugin_Component&[] */ $components // неопределённое количество компонентов больше одного
	) {
		$this->_file = $plugin_file;
		$this->_namespace = dirname( plugin_basename( $this->_file ) );
		$this->_slug = $this->_namespace;
		$basename = basename( $this->_file, '.php' );
		if ( 'main' != $basename ) {
			$this->_slug += '_' . $basename;
		};

		// register_activation_hook  ( $this->plugin_file, array( $this, 'on_activation' ) );
		// register_deactivation_hook( $this->plugin_file, array( $this, 'on_deactivation' ) );
		// register_uninstall_hook   ( $this->plugin_file, array( $this, 'on_uninstall' ) );

		$this->components = array();
		for ( $i = 1; $i < func_num_args(); $i++ ) {
			$next_arg =  func_get_arg( $i );
			if ( is_array( $next_arg ) ) {
				$this->components = array_merge( $this->components, $next_arg );
			} else {
				$this->components[] = $next_arg;
			};
		};

		foreach ( (array) $this->components as $component ) {
			$component->bind( $this );
			$component->bind_action_handlers_and_filters();
		};
		
	}

	private
	function __clone() {}

    private
	function __sleep() {}

    private
	function __wakeup() {}
}
?>