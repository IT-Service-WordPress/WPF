<?php 

namespace WPF\v1\TextDomain;

require_once ( 'wpf_plugin_component_base.php' );

/*
WPF_TextDomain class. Localization files loader for plugin.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
abstract
class Base
	extends
		\WPF\v1\Plugin\Component\Base
	implements
		\WPF\v1\Plugin\Component\IBase
{

	protected
	$text_domain;
	
	public
	function __construct (
		$text_domain
	) {
		$this->text_domain = $text_domain;
		$this->load_textdomain();
	}
	
	public
	function bind_action_handlers_and_filters() {
	}

	abstract
	public
	function get_text_domain_path();

	public
	function load_textdomain() {
		load_plugin_textdomain(
			$this->text_domain
			, false
			, $this->get_text_domain_path()
		); 
	}

}
?>