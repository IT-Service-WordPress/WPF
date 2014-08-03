<?php 

require_once ( 'wpf_inc.php' );
require_once ( 'wpf_compatibility_validator.php' );

/*
WPF_Version_Validator class.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
abstract
class WPF_Version_Validator extends WPF_Compatibility_Validator {

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