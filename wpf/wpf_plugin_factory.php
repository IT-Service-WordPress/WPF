<?php 

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! defined( 'WPF_DIR' ) ) {
	define( 'WPF_DIR', __DIR__ );
};

/*
WPF_Plugin_Factory class. Just metadata.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class WPF_Plugin_Factory {

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
		return $this->_text_domain_path;
	}

	public
	function get_network_support() {
		$this->load_data();
		return $this->_data[ 'Network' ];
	}

	public
	function __construct( 
		$plugin_file
		, $text_domain
		, $text_domain_path
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
	}

	private
	function __clone() {}

    private
	function __sleep() {}

    private
	function __wakeup() {}
}
?>