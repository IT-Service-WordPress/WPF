<?php 

require_once ( 'wpf_inc.php' );
require_once ( 'wpf_plugin_component.php' );
require_once ( 'wpf_compatibility_validator.php' );
require_once ( 'wpf_admin_notice.php' );

/*
WPF_Compatibility_Validators class. Software compatibility requirements validators collection.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
final
class WPF_Compatibility_Validators
	extends
		WPF_Plugin_Component
	implements
		IWPF_Plugin_Component
		, IWPF_Compatibility_Validator
{

	protected
	// array of IWPF_Compatibility_Validator
	$compatibility_requirements;

	public
	function __construct (
		// IWPF_Compatibility_Validator&[]
		array $compatibility_requirements
	) {
		$this->compatibility_requirements = $compatibility_requirements;
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
		add_action( 'admin_init', array( &$this, 'validate_and_deactivate_if_fails' ) ); 
	}
	
	public
	function validate(
		$produce_notices = false
	) {
		$are_meets = true;
		$errors = array();
		foreach ( (array) $this->compatibility_requirements as $validator ) {
			$return = $validator->validate();
			if ( is_wp_error( $return ) ) {
				$are_meets = false;
				array_push( $errors, $return->get_error_message() );
			};
		};
		if ( $produce_notices and ! $are_meets ) { 
			new WPF_admin_notice(
				array_merge(
					array( sprintf(
						__( 'Plugin "%1$s" compatibility check produced errors.', WPF_ADMINTEXTDOMAIN )
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