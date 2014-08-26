<?php 
/* 
Plugin Name:		WordPress plugin framework WPF v1
Plugin URI:			https://github.com/IT-Service-WordPress/wpf-v1
Description:		This plugin only provides a shared copy of the WPF framework (version 1) for other plugins. Use this plugin allows you to use the wordpress update mechanism to update the WPF framework.
Version:			0.1.0
Author:				Sergey S. Betke
Author URI:			http://sergey-s-betke.blogs.csm.nov.ru/about
Text Domain:		wpf
Domain Path:		/wpf/languages/
GitHub Plugin URI: 	https://github.com/IT-Service-WordPress/wpf-v1
*/

namespace WPF\v1;

define( 'WPFMUPv1', __FILE__ );
require_once( 'wpf-v1' . DIRECTORY_SEPARATOR . 'wpf_inc.php' );

?>