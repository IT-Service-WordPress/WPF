<?php
/*
WordPress-plugin-template plugin admin part.
*/

require_once ( 'wpf' . DIRECTORY_SEPARATOR . 'wpf_plugin_part_base.php' );
require_once ( 'wpf' . DIRECTORY_SEPARATOR . 'wpf_compatibility_validators.php' );
// require_once ( 'wpf' . DIRECTORY_SEPARATOR . 'wpf_compatibility_validators_on.php' );
require_once ( 'wpf' . DIRECTORY_SEPARATOR . 'wpf_compatibility_version_wp.php' );
require_once ( 'wpf' . DIRECTORY_SEPARATOR . 'wpf_compatibility_version_php.php' );
require_once ( 'wpf' . DIRECTORY_SEPARATOR . 'wpf_textdomain_plugin.php' );
require_once ( 'wpf' . DIRECTORY_SEPARATOR . 'wpf_textdomain_wpf.php' );
require_once ( 'wpf' . DIRECTORY_SEPARATOR . 'wpf_plugin_component_installer.php' );
require_once ( 'wpf' . DIRECTORY_SEPARATOR . 'wpf_gui_setting_page_pluginoptions.php' );
require_once ( 'wpf' . DIRECTORY_SEPARATOR . 'wpf_gui_setting_page_section_base.php' );
require_once ( 'wpf' . DIRECTORY_SEPARATOR . 'wpf_gui_setting_page_section_vgroup.php' );
require_once ( 'wpf' . DIRECTORY_SEPARATOR . 'wpf_gui_setting_page_control_text.php' );
require_once ( 'wpf' . DIRECTORY_SEPARATOR . 'wpf_gui_setting_page_control_input.php' );
require_once ( 'wpf' . DIRECTORY_SEPARATOR . 'wpf_plugin_component_dynamiccontroller.php' );


use \WPF\v1 as WPF;

new WPF\Plugin\Part\Base (
	new WPF\TextDomain\WPF( WPF\WPF_ADMINTEXTDOMAIN )

	/*
	, new WPF\Compatibility\Validators_On (
		'admin_init'
		, new WPF\Compatibility\Version\WP( '3.9.0' )
		, new WPF\Compatibility\Version\PHP( '5.5.0' )
		, new WPF\Compatibility\Version\PHP( '5.7.0' )
	)
	*/
	, new WPF\Compatibility\Validators (
		new WPF\Compatibility\Version\WP( '3.9.0' )
		, new WPF\Compatibility\Version\PHP( '5.5.0' )
	)
	
	, new WPF\GUI\Setting\Page\PluginOptions(
		new WPF\GUI\Setting\Page\Section\Base( 'id1', 'Первый раздел'
			, new WPF\GUI\Setting\Page\Control\Text(
				'Такой вот очень длинный текст. Такой вот очень длинный текст. Такой вот очень длинный текст. Такой вот очень длинный текст. ' 
				. 'Такой вот очень длинный текст. Такой вот очень длинный текст. Такой вот очень длинный текст. Такой вот очень длинный текст. ' 
				. 'Такой вот очень длинный текст. Такой вот очень длинный текст. Такой вот очень длинный текст. Такой вот очень длинный текст. ' 
				. 'Такой вот очень длинный текст. Такой вот очень длинный текст. Такой вот очень длинный текст. Такой вот очень длинный текст. ' 
				. 'Такой вот очень длинный текст. Такой вот очень длинный текст. Такой вот очень длинный текст. Такой вот очень длинный текст. ' 
			)
			, new WPF\GUI\Setting\Page\Control\Text(
				'Такой вот очень длинный текст. Такой вот очень длинный текст. Такой вот очень длинный текст. Такой вот очень длинный текст. ' 
			)
		)
		, new WPF\GUI\Setting\Page\Section\VGroup( 'id2', 'Второй раздел'
			, new WPF\GUI\Setting\Page\Control\Input( 'test-option' )
		)
		, 'id3'
	)
	, new WPF\GUI\Setting\Page\Section\VGroup( 'id3', 'Третий раздел'
		, new WPF\GUI\Setting\Page\Control\Text(
			'Такой вот очень длинный текст. Такой вот очень длинный текст. Такой вот очень длинный текст. Такой вот очень длинный текст. ' 
			. 'Такой вот очень длинный текст. Такой вот очень длинный текст. Такой вот очень длинный текст. Такой вот очень длинный текст. ' 
			. 'Такой вот очень длинный текст. Такой вот очень длинный текст. Такой вот очень длинный текст. Такой вот очень длинный текст. ' 
			. 'Такой вот очень длинный текст. Такой вот очень длинный текст. Такой вот очень длинный текст. Такой вот очень длинный текст. ' 
			. 'Такой вот очень длинный текст. Такой вот очень длинный текст. Такой вот очень длинный текст. Такой вот очень длинный текст. ' 
		)
		, new WPF\GUI\Setting\Page\Control\Text(
			'Такой вот очень длинный текст. Такой вот очень длинный текст. Такой вот очень длинный текст. Такой вот очень длинный текст. ' 
		)
	)

	, new WPF\Plugin\Component\Installer()
	, new WPF\Plugin\Component\DynamicController()
);

?>