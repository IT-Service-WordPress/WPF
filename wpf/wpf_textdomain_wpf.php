<?php 

namespace WPF\v1;

require_once ( 'wpf_inc.php' );
require_once ( 'wpf_textdomain.php' );

/*
WPF_TextDomain_WPF class. Localization files loader WPF framework.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class WPF_TextDomain_WPF
	extends
		WPF_TextDomain
	implements
		IWPF_Plugin_Component
{

	public
	function __construct (
		$text_domain = WPF_ADMINTEXTDOMAIN
	) {
		parent::__construct( $text_domain );
	}
	
	public
	function get_text_domain_path() {
		return plugin_basename( WPF_DIR ) . DIRECTORY_SEPARATOR . 'languages' . DIRECTORY_SEPARATOR;
	}

}
?>