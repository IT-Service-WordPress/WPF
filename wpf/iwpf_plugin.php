<?php 

namespace WPF\v1;

require_once ( 'wpf_inc.php' );

/*
IWPF_Plugin interface.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
interface IWPF_Plugin {

	public
	function get_file();

	public
	function get_slug();

	public
	function get_namespace();

	public
	function get_dir_path();

	public
	function get_dir_url();
	
	public
	function get_file_url(
		$path // Path to the plugin file of which URL you want to retrieve, relative to the plugin
	);
	
	public
	function get_file_path(
		$path // Path to the plugin file of which URL you want to retrieve, relative to the plugin
	);
	
	public
	function get_plugin_load_action_name();
	
	public
	function get_title();
	
	public
	function get_plugin_uri();
	
	public
	function get_version();
	
	public
	function get_description();
	
	public
	function get_author_name();
	
	public
	function get_author_uri();

	public
	function get_network_support();
	
	public
	function activate();

	public
	function deactivate();

	public
	function add_action(
		$hook
		, $function_to_add
		, $priority = 10
		, $accepted_args = 1
	);

}
?>