<?php 

namespace WPF\v1;

require_once ( 'wpf_inc.php' );
require_once ( 'wpf_textdomain.php' );

/*
WPF_TextDomain_Plugin class. Localization files loader for plugin.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class WPF_TextDomain_Plugin
	extends
		WPF_TextDomain
	implements
		IWPF_Plugin_Component
{

	protected
	$text_domain_path;

	public
	function __construct (
		$text_domain
		, $text_domain_path = '/languages/'
	) {
		parent::__construct( $text_domain );
		
		// $this->plugin->load_data();
		// $this->text_domain = $this->plugin->_data[ 'TextDomain' ];

		$this->text_domain_path = $text_domain_path;
		// $this->text_domain_path = $this->plugin->data[ 'DomainPath' ];
	}
	
	public
	function get_text_domain_path() {
		return dirname( plugin_basename( $this->plugin->get_file() ) ) . $this->text_domain_path;
	}

}
?>