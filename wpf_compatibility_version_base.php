<?php 

namespace WPF\v1\Compatibility\Version;

require_once ( 'wpf_compatibility_base.php' );

/*

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
abstract
class Base
	extends
		\WPF\v1\Compatibility\Base
{

	protected
	$required_version;

	public
	function __construct (
		$required_version
	) {
		parent::__construct();
		$this->required_version = $required_version;
	}

}
?>