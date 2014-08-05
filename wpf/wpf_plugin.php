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

	private
	$_text_domain;
	
	public
	function get_text_domain() {
		return $this->_text_domain;
	}

	private
	$_text_domain_path;

	public
	function get_text_domain_path() {
		return dirname( plugin_basename( $this->get_file() ) ) . $this->_text_domain_path;
	}

	public
	function _load_textdomain() {
		load_plugin_textdomain(
			$this->get_text_domain()
			, false
			, $this->get_text_domain_path()
		); 
		load_plugin_textdomain(
			WPF_TEXTDOMAIN
			, false
			, WPF_TEXTDOMAIN_PATH
		); 
		load_plugin_textdomain(
			WPF_ADMINTEXTDOMAIN
			, false
			, WPF_TEXTDOMAIN_PATH
		); 
		// !!! а если нет локализации у модуля? а деление на админ и фронтенд?
		// а теперь нужно загрузить локализацию для фреймворка, предварительно проверив, что она не загружена ещё
		// да и при загрузке локализации плагина так же проверить следует - для нескольких плагинов в одном флаконе локализация то одна будет.

	}
	
	public
	function get_network_support() {
		$this->load_data();
		return $this->_data[ 'Network' ];
	}
	
	protected
	// WPF_Compatibility_Validator[]
	$compatibility_requirements;
	
	public
	function activate() {
	}

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
		, $text_domain = null
		, $text_domain_path = null
		, IWPF_Plugin_Component& $compatibility_requirements
	) {
		$this->_file = $plugin_file;
		$this->_namespace = dirname( plugin_basename( $this->_file ) );
		$this->_slug = $this->_namespace;
		$basename = basename( $this->_file, '.php' );
		if ( 'main' != $basename ) {
			$this->_slug += '_' . $basename;
		};
		if ( ! is_null ( $text_domain ) ) {
			$this->_text_domain = $text_domain;
		} else {
			$this->load_data();
			$this->_text_domain = $this->_data[ 'TextDomain' ];
		};
		if ( $this->_text_domain ) {
			if ( ! is_null ( $text_domain_path ) ) {
				$this->_text_domain_path = $text_domain_path;
			} else {
				$this->load_data();
				$this->_text_domain_path = $this->_data[ 'DomainPath' ];
			};
		};
		
		if ( $compatibility_requirements ) {
			$this->compatibility_requirements = $compatibility_requirements;
			$this->compatibility_requirements->bind( $this );
			$this->compatibility_requirements->bind_action_handlers_and_filters();
		};

		add_action( 'plugins_loaded', array( $this, '_load_textdomain' ) ); 
	}

	private
	function __clone() {}

    private
	function __sleep() {}

    private
	function __wakeup() {}
}
?>