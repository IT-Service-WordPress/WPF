<?php 

require_once ( 'wpf_inc.php' );
require_once ( 'wpf_plugin_component.php' );

/*
WPF_TextDomain class. Localization files loader for plugin.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
final
class WPF_TextDomain
	extends
		WPF_Plugin_Component
	implements
		IWPF_Plugin_Component
{

	protected
	$text_domain;
	
	protected
	$text_domain_path;

	public
	function __construct (
		$text_domain
		, $text_domain_path = '/languages/'
	) {
		$this->text_domain = $text_domain;
		// $this->plugin->load_data();
		// $this->text_domain = $this->plugin->_data[ 'TextDomain' ];

		$this->text_domain_path = $text_domain_path;
		// $this->text_domain_path = $this->plugin->data[ 'DomainPath' ];
	}
	
	private
	function __clone() {}

    private
	function __sleep() {}

    private
	function __wakeup() {}
	
	public
	function bind_action_handlers_and_filters() {
		$this->check_bind();
		add_action( 'plugins_loaded', array( &$this, 'load_textdomain' ) ); 
	}
	
	public
	function get_text_domain_path() {
		return dirname( plugin_basename( $this->plugin->get_file() ) ) . $this->text_domain_path;
	}

	public
	function load_textdomain() {
		$this->check_bind();
		load_plugin_textdomain(
			$this->text_domain
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
	}

}
?>