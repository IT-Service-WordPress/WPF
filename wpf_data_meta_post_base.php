<?php

namespace WPF\v1\Data\Meta\Post;

require_once ( 'wpf_data_meta_post_ibase.php' );
require_once ( 'wpf_data_base.php' );

/*
WordPress meta descriptor class.

@since 1.1.0

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
	$hidden;

	protected
	function get_id() {
		return ( $this->hidden ) or ( $this->serialize ) ?
			'_' . $this->get_name()
			: $this->get_name()
		;
	}

	protected
	function _get_value() {
		global $post_ID;
		return ( $this->isset_value() ) ?
			\get_post_meta( $post_ID, $this->get_id(), true )
			: $this->default_value
		;
	}

	protected
	function _set_value(
		$new_value
	) {
		global $post_ID;
		return \update_post_meta( $post_ID, $this->get_id(), $new_value );
	}

	public
	function isset_value() {
		global $post_ID;
		return \metadata_exists( 'post', $post_ID, $this->get_id() );
	}

	public
	function unset_value() {
		global $post_ID;
		return \delete_post_meta( $post_ID, $this->get_id() );
	}

	public
	function add_value() {
	}

	public
	function delete_value() {
		return \delete_metadata( 'post', null, $this->get_id(), '', true );
	}

}
?>