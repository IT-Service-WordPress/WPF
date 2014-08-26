<?php 

namespace WPF\v1\Plugin\Part\Load;

require_once ( 'wpf_plugin_component_base.php' );
require_once ( 'wpf_predicates.php' );

/*
Component for loading external plugin parts (admin-side, frontend, so on).

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class Base
	extends
		\WPF\v1\Plugin\Component\Base
	implements
		\WPF\v1\Plugin\Component\IBase
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
		\add_action( $this->get_load_action_name(), array( &$this, 'load' ) ); 
	}
	
	final
	public
	function get_part_file() {
		$this->check_bind();
		return $this->plugin->get_file_path( $this->part_file );
	}
	
	protected
	static
	// \WPF\v1\Plugin\IBase&
	$plugin_instance;

	public
	static
	// \WPF\v1\Plugin\IBase&
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