<?php 

namespace WPF\v1\Plugin\Part\Load;

require_once ( 'wpf_plugin_part_load_if.php' );

/*
Component for loading admin side plugin part (on is_admin()).

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class Admin
	extends
		_If
	implements
		\WPF\v1\Plugin\Component\IBase
{

	public
	function __construct (
		$part_file = null
	) {
		parent::__construct( $part_file, 'is_admin' );
	}
	
	public
	function bind(
		\WPF\v1\Plugin\IBase& $plugin
	) {
		parent::bind( $plugin );
		if ( ! $this->part_file ) {
			$this->part_file = basename( $this->plugin->get_file(), '.php' ) . '-admin.php';
		};
	}
	
}
?>