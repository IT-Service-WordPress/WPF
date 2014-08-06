<?php 

namespace WPF\v1;

require_once ( 'wpf_inc.php' );
require_once ( 'wpf_plugin_component.php' );
require_once ( 'wpf_predicates.php' );

/*
WPF_Plugin_Part_Load class. Component for loading external plugin parts (admin-side, frontend, so on).

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class WPF_Plugin_Part_Load
	extends
		WPF_Plugin_Component
	implements
		IWPF_Plugin_Component
{

	protected
	$part_file;
	
	public
	function __construct (
		$part_file
	) {
		parent::__construct();
		$this->part_file = $part_file;
	}
	
	protected
	function get_load_action_name() {
		return $this->plugin->get_plugin_load_action_name();
	}

	public
	function bind_action_handlers_and_filters() {
		$this->check_bind();
		$this->plugin->add_action( $this->get_load_action_name(), array( $this, 'load' ) ); 
	}
	
	final
	public
	function get_part_file() {
		$this->check_bind();
		return $this->plugin->get_file_path( $this->part_file );
	}
	
	protected
	static
	// IWPF_Plugin&
	$plugin_instance;

	public
	static
	// IWPF_Plugin&
	function get_plugin_instance() {
		return self::$plugin_instance;
	}

	public
	function load() {
		$this->check_bind();
		self::$plugin_instance = $this->plugin;
		require( $this->get_part_file() );
		self::$plugin_instance = null;
	}
	
}
?>