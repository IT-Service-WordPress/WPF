<?php 

namespace WPF\v1\Compatibility;

require_once ( 'wpf_inc.php' );
require_once ( 'wpf_plugin_component_base.php' );
require_once ( 'wpf_compatibility_ibase.php' );
require_once ( 'wpf_gui_notice_admin.php' );
require_once ( 'wpf_collection.php' );

/*
Software compatibility requirements validators collection, fired on specified action.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
final
class Validators_On
	extends
		\WPF\v1\Plugin\Component\Base
	implements
		\WPF\v1\Plugin\Component\IBase
		, IBase
{

	protected
	// \WPF\v1\Collection&
	$compatibility_requirements;

	protected
	$action;

	public
	function __construct (
		$action = 'admin_init'
		// IBase&[]
		, $compatibility_requirements
	) {
		parent::__construct();
		$this->action = $action;
		$this->compatibility_requirements  = new \WPF\v1\Collection(
			array_slice( func_get_args(), 1 )
		);
	}
	
	private
	function __clone() {}

    private
	function __sleep() {}

    private
	function __wakeup() {}
	
	public
	function bind_action_handlers_and_filters() {
		$this->check_bind();
		\add_action( $this->action, array( &$this, 'validate_and_deactivate_if_fails' ) ); 
	}
	
	public
	function validate(
		$produce_notices = false
	) {
		$are_meets = true;
		$errors = array();
		foreach ( $this->compatibility_requirements as $validator ) {
			$return = $validator->validate();
			if ( is_wp_error( $return ) ) {
				$are_meets = false;
				array_push( $errors, $return->get_error_message() );
			};
		};
		if ( $produce_notices and ! $are_meets ) { 
			new \WPF\v1\GUI\Notice\Admin(
				array_merge(
					array( sprintf(
						__( 'Plugin "%1$s" compatibility check produced errors.', \WPF\v1\WPF_ADMINTEXTDOMAIN )
						, $this->plugin->get_title()
					) )
					, $errors
				)
				, 'error'
			);
		};
		return $are_meets;
	}
	
	public
	function validate_and_deactivate_if_fails() {
		if ( ! $this->validate( true ) ) {
			$this->plugin->deactivate();
		};
	}

}
?>