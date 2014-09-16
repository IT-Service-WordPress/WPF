<?php

namespace WPF\v1\GUI\Group;

require_once ( 'wpf_gui_group_base.php' );
require_once ( 'wpf_gui_datamanipulator_ibase.php' );

/*
Collection of UI components for data controllers.

@since 1.1.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
trait Controller
{
	use Base{
		Base::after_bind as group_after_bind;
	}

	protected
	function after_bind() {
		$this->group_after_bind();
		foreach ( $this->get_components_recursive( '\WPF\v1\GUI\DataManipulator\IBase' ) as $data_manipulator ) {
			$data_manipulator->bind_controller( $this );
		};
	}

}
?>