<?php 

namespace WPF\v1\Plugin\Part\Load;

require_once ( 'wpf_inc.php' );
require_once ( 'wpf_plugin_part_load.php' );

/*
Component for loading external plugin parts on specified action (admin-side, frontend, so on).

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class _On
	extends
		Base
	implements
		\WPF\v1\Plugin\Component\IBase
{

	protected
	$part_loading_action;
	
	public
	function __construct (
		$part_file
		, $part_loading_action = 'init'
	) {
		parent::__construct( $part_file );
		$this->part_loading_action = $part_loading_action;
	}
	
	protected
	function get_load_action_name() {
		return $this->part_loading_action;
	}

}
?>