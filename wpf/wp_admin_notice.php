<?php 

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/*
WP_admin_notice class. This class should ideally be used to work with the
administrative side of the WordPress site.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class WP_admin_notice {

	protected
	$message;

	protected
	$message_type;

	/*
	Locate a template
	
	Allows parent/child themes to override the markup by placing the a file named basename( $default_template_path ) in their root folder,
	and also allows plugins or themes to override the markup by a filter. Themes might prefer that method if they place their templates
	in sub-directories to avoid cluttering the root folder. In both cases, the theme/plugin will have access to the variables so they can
	fully customize the output.
	
	@TODO добавить возможность кастомизации шаблонов отображений непосредственно в плагине. Для этого нужно иметь каталог плагина!
	С учётом возможности применения в разных плагинах этих классов.

	@since 1.0.0

	@mvc @model
	
	@param  string $default_template_path The path to the template, relative to the plugin's `views` folder
	@param  array  $variables             An array of variables to pass into the template's scope, indexed with the variable name so that it can be extract()-ed
	@param  string $require               'once' to use require_once() | 'always' to use require()
	@return string						  located templates
	*/
	protected
	function locate_template(
		$template_names
		, $load = false
		, $require_once = true
	) {
		$located = '';
		$located = locate_template( $template_names );
		
		if ( !$located ) {
			foreach ( (array) $template_names as $template_name ) {
				if ( !$template_name )
					continue;
				$test_path = dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . $template_name;
				if ( file_exists( $test_path ) ) {
					$located = $test_path;
					break;
				}
			}
		}
		if ( $load && '' != $located )
			$this->load_template( $located, $require_once );

		return $located;
	}

	/*
	Require the template file with WordPress environment.
	
	The globals are set up for the template file to ensure that the WordPress
	environment is available from within the function. The query variables are
	also available.
	
	@since 1.0.0

	@param string $_template_file Path to template file.
	@param bool $require_once Whether to require_once or require. Default true.
	*/
	protected
	function load_template(
		$_template_file
		, $require_once = true
	) {
		global $posts, $post, $wp_did_header, $wp_query, $wp_rewrite, $wpdb, $wp_version, $wp, $id, $comment, $user_ID;

		if ( is_array( $wp_query->query_vars ) )
			extract( $wp_query->query_vars, EXTR_SKIP );

		if ( $require_once )
			require_once( $_template_file );
		else
			require( $_template_file );
	}

	public
	function display() {
		$this->locate_template( 'admin_notice.php', true, 'always' );
	}
	
	public
	function __construct (
		$message
		, $type = 'updated' // 'updated', 'error', 'update-nag'
	) {
		$this->message = $message;
		$this->message_type = $type;
		add_action( 'admin_notices', array( &$this, 'display' ) );
	}

	private
	function __clone() {}

    private
	function __sleep() {}

    private
	function __wakeup() {}
}
?>