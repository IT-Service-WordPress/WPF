<?php 

namespace WPF\v1\Plugin\Part;

require_once ( 'wpf_plugin_part_base.php' );
require_once ( 'wpf_plugin_component_idependable.php' );

/*
Plugin part container (admin-side, frontend, so on) with advanced functions:

- auto create dependencies for some classes

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class Advanced
	extends
		Base
{

	public
	function bind(
		\WPF\v1\Plugin\IBase& $plugin
	) {
		parent::bind( $plugin );

		$dependencies = array(
			'\WPF\v1\Plugin\Component\IInstaller' => false
			, '\WPF\v1\Plugin\Component\IActivator' => false
			, '\WPF\v1\Plugin\Component\IDynamicController' => false
			, '\WPF\v1\Compatibility\IBase' => true
		);
		foreach ( $this->plugin->get_components( '\WPF\v1\Plugin\Component\IDependable' ) as $component ) {
			foreach ( $component->get_dependencies() as $dependency ) {
				$dependencies[ $dependency ] = true;
			};
		};
		if ( 
			$dependencies[ '\WPF\v1\Plugin\Component\IDynamicController' ]
			|| $dependencies[ '\WPF\v1\Plugin\Component\IInstaller' ]
		) {
			// strong before Installer !
			if ( ! $this->plugin->has_component( '\WPF\v1\Plugin\Component\IDynamicController' ) ) {
				require_once ( 'wpf_plugin_component_dynamiccontroller.php' );
				$this->plugin->add_components(
					new \WPF\v1\Plugin\Component\DynamicController()
				);
			};
		};
		if ( $dependencies[ '\WPF\v1\Plugin\Component\IInstaller' ] ) {
			// strong before Activator !
			if ( ! $this->plugin->has_component( '\WPF\v1\Plugin\Component\IInstaller' ) ) {
				require_once ( 'wpf_plugin_component_installer.php' );
				$this->plugin->add_components(
					new \WPF\v1\Plugin\Component\Installer()
				);
			};
		};
		if ( $dependencies[ '\WPF\v1\Plugin\Component\IActivator' ] ) {
			if ( ! $this->plugin->has_component( '\WPF\v1\Plugin\Component\IActivator' ) ) {
				require_once ( 'wpf_plugin_component_activator.php' );
				$this->plugin->add_components(
					new \WPF\v1\Plugin\Component\Activator()
				);
			};
		};
		if ( $dependencies[ '\WPF\v1\Compatibility\IBase' ] ) {
			if ( ! $this->plugin->has_component( '\WPF\v1\Compatibility\IBase' ) ) {
				require_once ( 'wpf_compatibility_validators.php' );
				require_once ( 'wpf_compatibility_version_wp.php' );
				require_once ( 'wpf_compatibility_version_php.php' );
				$this->plugin->add_components(
					new \WPF\v1\Compatibility\Validators (
						new \WPF\v1\Compatibility\Version\WP( '3.9.0' )
						, new \WPF\v1\Compatibility\Version\PHP( '5.5.0' )
					)
				);
			};
		};
	}

}
?>