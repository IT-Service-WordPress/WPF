<?php
/* 
Plugin Name:		WordPress-plugin-template
Plugin URI:			http://sergey-s-betke.blogs.csm.nov.ru/category/web/wordpress/
Description:		Automatically send HTTP 1.1 headers "Cache-control", "Pragma" and "Expires".
Version:			0.1.0
Author:				Sergey S. Betke
Author URI:			http://sergey-s-betke.blogs.csm.nov.ru/about
Text Domain:		wordpress-plugin-template
Domain Path:		/languages/
GitHub Plugin URI: 	https://github.com/sergey-s-betke/WordPress-plugin-template
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

require_once (  'wpf' . DIRECTORY_SEPARATOR . 'wpf_plugin.php' );
require_once (  'wpf' . DIRECTORY_SEPARATOR . 'wpf_compatibility_validators.php' );
require_once (  'wpf' . DIRECTORY_SEPARATOR . 'wpf_wp_version_validator.php' );
require_once (  'wpf' . DIRECTORY_SEPARATOR . 'wpf_php_version_validator.php' );
require_once (  'wpf' . DIRECTORY_SEPARATOR . 'wpf_textdomain.php' );

$zzz_plugin = new WPF_Plugin (
	__FILE__
	, new WPF_Compatibility_Validators ( array (
		new WPF_WP_Version_Validator( '3.9.9' )
		, new WPF_PHP_Version_Validator( '5.6.7' )
	) )
	, new WPF_TextDomain ( 'wordpress-plugin-template' )
);

/*

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
	$plugin_instance;

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
*/

?>