<?php

namespace WPF\v1\Data\Option;

require_once ( 'wpf_data_option_ibase.php' );
require_once ( 'wpf_data_base.php' );

/*
Option descriptor class.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class Base
	extends
		\WPF\v1\Data\Base
	implements
		IBase
{

	protected
	// bool
	$autoload;

	protected
	function _get_value() {
		return \get_option( $this->get_name(), $this->default_value );
	}

	protected
	function _set_value(
		$new_value
	) {
		return \update_option( $this->get_name(), $new_value );
	}

	public
	function isset_value() {
		return ( ! is_null( \get_option( $this->get_name(), null ) ) );
	}

	public
	function unset_value() {
		return \update_option( $this->get_name(), $this->default_value );
	}

	public
	function add_value() {
		\add_option(
			$this->get_name()
			, $this->default_value ? $this->default_value : ''
			, ''
			, $this->autoload ? 'yes' : 'no'
		);
		// !!!! netwotk wide ? !!!! add_site_option
	}

	public
	function delete_value() {
		\delete_option(
			$this->get_name()
		);
		// !!!! netwotk wide ? !!!! delete_site_option
	}

}
?>