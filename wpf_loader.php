<?php 
/*
Wordpress Plugin framework common header file.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/

namespace WPF\v1;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class Loader
{

	protected
	static
	$root_dir;

	public
	static
	function set_root_dir(
		$dir = ''
	) {
		self::$root_dir = self::calc_dir( $dir ?
			$dir
			: self::get_root_dir()
		);
	}

	public
	static
	function calc_dir(
		$dir
	) {
		return
			WP_PLUGIN_DIR
			. DIRECTORY_SEPARATOR
			. $dir
		;
	}

	public
	static
	function get_file(
		$short_file_name
		, $root_dir = null
	) {
		return 
			$root_dir ? self::calc_dir( $root_dir ) : self::$root_dir
			. $short_file_name
		;
	}

	public
	static
	function _require_once(
		$short_file_name
		, $root_dir = null
	) {
		require_once( self::get_file( $short_file_name, $root_dir ) );
	}

	public
	static
	function get_root_dir() {
		return
			str_replace(
				array( '/', '\\' )
				, DIRECTORY_SEPARATOR
				, \plugin_basename( __DIR__ )
			)
			. DIRECTORY_SEPARATOR
		;
	}

};

?>