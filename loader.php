<?php 
/* 
Plugin Name:		WordPress-plugin-template
Plugin URI:			http://sergey-s-betke.blogs.csm.nov.ru/category/web/wordpress/
Description:		Automatically send HTTP 1.1 headers "Cache-control", "Pragma" and "Expires".
Version:			0.1.0
Author:				Sergey S. Betke
Author URI:			http://sergey-s-betke.blogs.csm.nov.ru/about
Text Domain:		wordpress-plugin-template
Domain Path:		/languages
GitHub Plugin URI: 	https://github.com/sergey-s-betke/WordPress-plugin-template
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class WP_admin_notice {

	protected
	$message;

	protected
	$message_type;

	public
	function show_message() {
		echo
			'<div class="'. $this->message_type . '">'
			. $this->message
			. '</div>'
		;
	}
	
	public
	function __construct (
		$message
		, $type = 'updated' // 'updated', 'error', 'update-nag'
	) {
		$this->message = $message;
		$this->message_type = $type;
		add_action( 'admin_notices', array( $this, 'show_message' ) );
	}
	
}

abstract
class WP_Activation_Validator {

	protected
	/* WP_Plugin */ $plugin;

	abstract
	public
	function validate();
	
	final
	public
	function _validate() {
		try {
			$this->validate();
		} catch ( Exception $error ) {
			new WP_admin_notice( $error->getMessage(), 'error' );
			$this->plugin->deactivate();
		};
	}

	public
	function __construct (
		WP_Plugin & $plugin
	) {
		$this->plugin = $plugin;
		add_action( 'admin_init', array( $this, '_validate' ) ); 
	}
	
}

abstract
class WP_Plugin {

	private
	$plugin_file;
	
	public
	function get_name() {
		return dirname( plugin_basename( $this->plugin_file ) );
	}

	protected
	$version = '0.1.0';

	public
	function get_version() {
		return $this->version;
	}

	protected
	function get_namespace() {
		return dirname( plugin_basename( $this->plugin_file ) );
	}

	protected
	function get_textdomain() {
		return dirname( plugin_basename( $this->plugin_file ) );
	}

	protected
	function get_path() {
		return plugin_dir_path( $this->plugin_file );
	}

	protected
	function get_file_URL(
		$pluginFileName
	) {
		return plugins_url( $pluginFileName, $this->plugin_file );
	}
	
	public
	function on_activation() {
	}
	
	public
	function deactivate() {
		if ( current_user_can( 'activate_plugins' ) ) {
			deactivate_plugins( $this->plugin_file );
		};
		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
	}
	
	public
	function on_deactivation() {
	}
	
	public
	static
	function on_uninstall() {
	}
	
	public
	function on_init() {
	}
	
	public
	function __construct( 
		$plugin_file
	) {
		$this->plugin_file = plugin_basename( $plugin_file );
		register_activation_hook  ( $this->plugin_file, array( $this, 'on_activation' ) );
		register_deactivation_hook( $this->plugin_file, array( $this, 'on_deactivation' ) );
		register_uninstall_hook   ( $this->plugin_file, array( $this, 'on_uninstall' ) );
		add_action( 'init', array( $this, 'on_init' ) );
	}

}

class WP_plugin_loader {

	protected
	$plugin_file;
	
	protected
	$plugin_class;
	
	protected
	/* WP_Plugin */ $plugin_instance;

	public
	function on_plugins_loaded() {
		if ( is_null( $this->plugin_instance ) ) {
			$this->plugin_instance = new $this->plugin_class ( $this->plugin_file );
		};
		return $this->plugin_instance;
	}
	
	public
	function __construct (
		$plugin_file
		, $plugin_class
	) {
		$this->plugin_class = $plugin_class;
		$this->plugin_file = $plugin_file;
		add_action( 'plugins_loaded', array( $this, 'on_plugins_loaded' ) );
	}
	
}

abstract
class WP_Version_Validator extends WP_Activation_Validator {

	public
	$required_version;

	public
	function __construct (
		WP_Plugin & $plugin
		, $required_version
	) {
		$this->required_version = $required_version;
		parent::__construct( $plugin );
	}
	
}

class WP_WP_Version_Validator extends WP_Version_Validator {

	public
	function validate() {
		if (
			version_compare( get_bloginfo( 'version' ), $this->required_version, "<" )
		) {
			throw new Exception( 
				sprintf(
					__( '<p>Plugin %1$s requires WordPress %2$s or newer. <a href="%3$s">Please update!</a>.</p>' )
					, $this->plugin->get_name()
					, $this->required_version
					, admin_url( 'update-core.php' )
				)
			);
		};
	}

}

class WP_PHP_Version_Validator extends WP_Version_Validator {

	public
	function validate() {
		global $php_version;
		if (
			version_compare( $php_version, $this->required_version, "<" )
		) {
			throw new Exception( 
				sprintf(
					__( '<p>Plugin %1$s requires PHP %2$s or newer. Please update!</p>' )
					, $this->plugin->get_name()
					, $this->required_version
				)
			);
		};
	}

}

class Cache_Control_headers extends WP_Plugin {

	public
	function __construct( 
		$plugin_file
	) {
		parent::__construct( $plugin_file );
		new WP_WP_Version_Validator( $this, '3.9.0' );
		new WP_PHP_Version_Validator( $this, '5.6.7' );
	}

}

new WP_plugin_loader( __FILE__, 'Cache_Control_headers' );

?>