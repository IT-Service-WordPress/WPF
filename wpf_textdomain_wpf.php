<?php 

namespace WPF\v1\TextDomain;

require_once ( 'wpf_inc.php' );
require_once ( 'wpf_textdomain_base.php' );

/*
Localization files loader WPF framework.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class WPF
	extends
		Base
	implements
		\WPF\v1\Plugin\Component\IBase
{

	public
	function __construct (
		$text_domain = WPF_ADMINTEXTDOMAIN
	) {
		parent::__construct( $text_domain );
	}
	
	public
	function get_text_domain_path() {
		return plugin_basename( __DIR__ ) . DIRECTORY_SEPARATOR . 'languages' . DIRECTORY_SEPARATOR;
	}

}
?>