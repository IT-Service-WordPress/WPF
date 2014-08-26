<?php 

namespace WPF\v1\GUI;

/*
Functions for plugin templates processing.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/

/*
Locate a template

Allows parent/child themes to override the markup by placing the a file named basename( $default_template_path ) in their root folder,
and also allows plugins or themes to override the markup by a filter. Themes might prefer that method if they place their templates
in sub-directories to avoid cluttering the root folder. In both cases, the theme/plugin will have access to the variables so they can
fully customize the output.

@since 1.0.0

@mvc @model

@param  string $default_template_path The path to the template, relative to the plugin's `views` folder
@param  array  $variables             An array of variables to pass into the template's scope, indexed with the variable name so that it can be extract()-ed
@param  string $require               'once' to use require_once() | 'always' to use require()
@return string						  located templates
*/
function locate_template(
	$template_names
	, $plugin_file = __FILE__
	, $load = false
	, $require_once = true
) {
	$located = '';
	$located = \locate_template( $template_names );
	
	if ( !$located ) {
		foreach ( (array) $template_names as $template_name ) {
			if ( !$template_name )
				continue;
			$test_path = dirname( $plugin_file ) . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . $template_name;
			if ( file_exists( $test_path ) ) {
				$located = $test_path;
				break;
			}
			$test_path = WPF_DIR . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . $template_name;
			if ( file_exists( $test_path ) ) {
				$located = $test_path;
				break;
			}
		}
	}
	if ( $load && '' != $located )
		\load_template( $located, $require_once );

	return $located;
}

?>