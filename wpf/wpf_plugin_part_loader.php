<?php 

namespace WPF\v1;

require_once ( 'wpf_inc.php' );
require_once ( 'wpf_plugin_component.php' );

/*
WPF_Plugin_Part_Def class. Component for loading external plugin parts (admin-side, frontend, so on).

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class WPF_Plugin_Part_Loader
	extends
		WPF_Plugin_Component
	implements
		IWPF_Plugin_Component
{

	protected
	$part_file;
	
	protected
	$part_loading_action;
	
	public
	function __construct (
		$part_file
		, $part_loading_action = 'load_plugin'
	) {
		parent::__construct();
		$this->part_file = $part_file;
		if ( $part_loading_action ) {
			$this->part_loading_action = $part_loading_action;
		};
	}
	
	public
	function bind_action_handlers_and_filters() {
		$this->check_bind();
		if ( 'load_plugin' === $this->part_loading_action ) {
			$this->part_loading_action = $this->plugin->get_plugin_load_action_name();
		};
		$this->plugin->add_action( $this->part_loading_action, array( $this, 'check_and_load' ) ); 
	}
	
	final
	public
	function get_part_file() {
		$this->check_bind();
		return $this->plugin->get_file_path( $this->part_file );
	}
	
	protected
	function check_conditions() {
		return true;
	}

	public
	function check_and_load() {
		if ( $this->check_conditions() ) {
			$this->load();
		};
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

	protected
	function load() {
		$this->check_bind();
		self::$plugin_instance = $this->plugin;
		require( $this->get_part_file() );
		self::$plugin_instance = null;
	}
	
}
?>