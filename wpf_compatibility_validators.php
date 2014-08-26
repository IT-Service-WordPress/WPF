<?php 

namespace WPF\v1\Compatibility;

require_once ( 'wpf_plugin_component_base.php' );
require_once ( 'wpf_compatibility_ibase.php' );
require_once ( 'wpf_collection.php' );

/*
Software compatibility requirements validators collection.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class Validators
	extends
		\WPF\v1\Plugin\Component\Base
	implements
		\WPF\v1\Plugin\Component\IBase
		, IBase
{

	protected
	// \WPF\v1\Collection&
	$compatibility_requirements;

	public
	function __construct (
		// IBase&[]
		$compatibility_requirements
	) {
		parent::__construct();
		$this->compatibility_requirements  = new \WPF\v1\Collection(
			func_get_args()
		);
	}
	
	public
	function bind_action_handlers_and_filters() {
		$this->check_bind();
		$this->plugin->register_activation_hook( array( &$this, 'require_validation' ) );
	}
	
	public
	function validate() {
		$are_meets = true;
		$errors = new \WP_Error(
			'error'
			, sprintf(
				__( 'Plugin "%1$s" compatibility check produced errors.', \WPF\v1\WPF_ADMINTEXTDOMAIN )
				, $this->plugin->get_title()
			)
		);
		foreach ( $this->compatibility_requirements as $validator ) {
			$return = $validator->validate();
			if ( is_wp_error( $return ) ) {
				$are_meets = false;
				$errors->add(
					$return->get_error_code()
					, $return->get_error_message()
				);
			};
		};
		return $are_meets ? true : $errors;
	}
	
	public
	function require_validation() {
		$errors = $this->validate();
		if ( is_wp_error( $errors ) ) {
			require_once ( 'wpf_gui_templates.php' );
			$_template_file = \WPF\v1\GUI\locate_template( 'plugin_activation_error.php' );
			require( $_template_file );
			
			set_error_handler( array( &$this, 'error_handler' ) );
			trigger_error( $errors->get_error_message(), E_USER_ERROR );
		};
	}

	public
	function error_handler( 
		$errno
		, $errmsg
		, $errfile
		, $errline
	) {
		die();
	}
}
?>