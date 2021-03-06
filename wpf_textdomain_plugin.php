<?php 

namespace WPF\v1\TextDomain;

require_once ( 'wpf_inc.php' );
require_once ( 'wpf_textdomain_base.php' );

/*
Localization files loader for plugin.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class Plugin
	extends
		Base
	implements
		\WPF\v1\Plugin\Component\IBase
{

	protected
	$text_domain_path;

	public
	function __construct (
		$text_domain
		, $plugin_file
		, $text_domain_path = '/languages/'
	) {
		$this->text_domain_path =
			dirname( plugin_basename( $plugin_file ) ) . $text_domain_path;
			$text_domain_path
		;
		parent::__construct( $text_domain );
		
		// $this->text_domain = $this->plugin->_data[ 'TextDomain' ];
		// $this->text_domain_path = $this->plugin->data[ 'DomainPath' ];
	}
	
	public
	function get_text_domain_path() {
		return $this->text_domain_path;
	}

}
?>