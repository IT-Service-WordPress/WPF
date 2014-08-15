<?php 

namespace WPF\v1\Plugin;

require_once ( 'wpf_inc.php' );

/*


@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
interface IBase {

	public
	function get_file();

	public
	function get_basename();
	
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
	function get_title(
		$markup = true
	);
	
	public
	function get_plugin_uri();
	
	public
	function get_version();
	
	public
	function get_description(
		$markup = true
	);
	
	public
	function get_author_name(
		$markup = true
	);
	
	public
	function get_author_uri();

	public
	function get_network_support();

	public
	function add_components(
		/* Component\IBase& */ $components // неопределённое количество компонентов больше одного
	);

	public
	function has_component(
		$component_type // interface id
	);

	public
	function get_components(
		$component_type = null // interface id, or null for all components
	);

	public
	function activate();

	public
	function deactivate();

	public
	function register_activation_hook(
		$function
	);

	public
	function register_deactivation_hook(
		$function
	);

	public
	function register_uninstall_hook(
		$function
	);
}
?>