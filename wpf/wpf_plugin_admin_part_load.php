<?php 

namespace WPF\v1;

require_once ( 'wpf_inc.php' );
require_once ( 'wpf_plugin_part_load_if.php' );

/*
WPF_Plugin_Admin_Part_Load class. Component for loading admin side plugin part (on is_admin()).

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class WPF_Plugin_Admin_Part_Load
	extends
		WPF_Plugin_Part_Load_If
	implements
		IWPF_Plugin_Component
{

	public
	function __construct (
		$part_file = null
	) {
		parent::__construct( $part_file, 'is_admin' );
	}
	
	public
	function bind(
		IWPF_Plugin& $plugin
	) {
		parent::bind( $plugin );
		if ( ! $this->part_file ) {
			$this->part_file = basename( $this->plugin->get_file(), '.php' ) . '-admin.php';
		};
	}
	
}
?>