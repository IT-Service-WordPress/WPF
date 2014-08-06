<?php 

namespace WPF\v1;

require_once ( 'wpf_inc.php' );
require_once ( 'wpf_plugin_part_load.php' );
require_once ( 'wpf_predicates.php' );

/*
WPF_Plugin_Part_Load_If class. Component for loading external plugin parts if predicate is true (admin-side, frontend, so on).

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class WPF_Plugin_Part_Load_If
	extends
		WPF_Plugin_Part_Load
	implements
		IWPF_Plugin_Component
{

	protected
	$predicate;
	
	public
	function __construct (
		$part_file
		, callable $predicate
	) {
		parent::__construct( $part_file );
		$this->predicate = $predicate;
	}
	
	public
	function load() {
		if ( call_user_func( $this->predicate ) ) {
			parent::load();
		};
	}
	
}
?>