<?php 

namespace WPF\v1\Setting;

require_once ( 'wpf_inc.php' );
require_once ( 'wpf_setting_ibase.php' );
require_once ( 'wpf_plugin_component_updatable.php' );

/*
Setting descriptor class.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class Base
	extends
		\WPF\v1\Plugin\Component\Updatable
	implements
		IBase
{

	protected
	$option_group;

	protected
	$option_name;

	protected
	$default_value;

	protected
	// bool
	$autoload;

	protected
	$sanitize_callback;

	public
	function __construct(
		$option_group
		, $option_name
		, $default_value = null
		, $autoload = true
		, callable $sanitize_callback = null
	) {
		parent::__construct();
		$this->option_group = $option_group;
		$this->option_name = $option_name;
		$this->default_value = $default_value;
		$this->autoload = $autoload;
		$this->sanitize_callback = $sanitize_callback;
	}

	public
	function bind_action_handlers_and_filters() {
		parent::bind_action_handlers_and_filters();
		\add_action( 'admin_init', array( &$this, 'register_setting' ) );
	}

	public
	function get_option_group() {
		return $this->option_group;
	}

	public
	function get_option_name() {
		return $this->option_name;
	}

	public
	function get_sanitize_callback() {
		return $this->sanitize_callback ? $this->sanitize_callback : '';
	}

	public
	function get_value() {
	}

	public
	function set_value() {
	}

	public
	function activate() {
	}
	
	public
	function deactivate() {
		$this->unregister_setting();
	}

	public
	function install() {
		\add_option(
			$this->get_option_name()
			, $this->default_value ? $this->default_value : ''
			, ''
			, $this->autoload ? 'yes' : 'no'
		);
		// !!!! netwotk wide ? !!!! add_site_option
	}
	
	public
	function uninstall() {
		\delete_option(
			$this->get_option_name()
		);
		// !!!! netwotk wide ? !!!! delete_site_option
	}

	public
	function update(
		$from_version
	) {
		$this->install();
	}

	public
	function register_setting() {
		\register_setting(
			$this->get_option_group()
			, $this->get_option_name()
			, $this->get_sanitize_callback()
		);
	}

	public
	function unregister_setting() {
		\unregister_setting(
			$this->get_option_group()
			, $this->get_option_name()
			, $this->get_sanitize_callback()
		);
	}

}
?>