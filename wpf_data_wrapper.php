<?php

namespace WPF\v1\Data;

/*
Data wrapper class for serialization of options and metas.

@since 1.1.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
final
class Wrapper
{

	protected
	$value;
	
	public
	function __construct(
		$value
	) {
		$this->value = $value;
	}
	
	public
	function get_value() {
		return $this->value;
	}

	public
	function __sleep() {
		return array( 'value' );
	}

	public
	function __wakeup() {
	}

}
?>