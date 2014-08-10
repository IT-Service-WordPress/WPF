<?php 

namespace WPF\v1\Compatibility;

require_once ( 'wpf_inc.php' );
require_once ( 'wpf_compatibility_validators.php' );

/*
Software compatibility requirements validators collection, fired on specified action.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class Validators_On
	extends
		Validators
{

	protected
	$action;

	public
	function __construct (
		$action = 'admin_init'
		// IBase&[]
		, $compatibility_requirements
	) {
		parent::__construct( array_slice( func_get_args(), 1 ) );
		$this->action = $action;
	}
	
	public
	function bind_action_handlers_and_filters() {
		$this->check_bind();
		\add_action( $this->action, array( &$this, 'require_validation' ) ); 
	}
	
	public
	function require_validation() {
		$errors = $this->validate();
		if ( is_wp_error( $errors ) ) {
			require_once ( 'wpf_gui_notice_admin.php' );
			foreach ( (array) $errors->errors as $code => $messages ) {
				new \WPF\v1\GUI\Notice\Admin( $messages, $code );
			};
			$this->plugin->deactivate();
		};
	}

}
?>