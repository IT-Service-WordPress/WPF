<?php 

namespace WPF\v1\Compatibility;

require_once ( 'wpf_inc.php' );
require_once ( 'iwpf_compatibility_validator.php' );

/*
Software compatibility requirements validators base class.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
abstract
class Base
	implements
		IBase
{

	abstract
	public
	function validate();
	
	public
	function __construct () {}
	
	private
	function __clone() {}

    private
	function __sleep() {}

    private
	function __wakeup() {}
}
?>