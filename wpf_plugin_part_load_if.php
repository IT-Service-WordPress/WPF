<?php 

namespace WPF\v1\Plugin\Part\Load;

require_once ( 'wpf_inc.php' );
require_once ( 'wpf_plugin_part_load_base.php' );
require_once ( 'wpf_predicates.php' );

/*
Component for loading external plugin parts if predicate is true (admin-side, frontend, so on).

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class _If
	extends
		Base
	implements
		\WPF\v1\Plugin\Component\IBase
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