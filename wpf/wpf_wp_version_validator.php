<?php 

namespace WPF\v1\Compatibility\Version;

require_once ( 'wpf_inc.php' );
require_once ( 'wpf_version_validator.php' );

/*


@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class WP
	extends
		Base
	implements
		\WPF\v1\Compatibility\IBase
{

	public
	function validate() {
		if (
			version_compare( get_bloginfo( 'version' ), $this->required_version, "<" )
		) {
			return new \WP_Error(
				'error'
				, sprintf(
					__( 'WordPress %1$s or newer is required. Current version - %2$s. <a href="%3$s">Please update!</a>', \WPF\v1\WPF_ADMINTEXTDOMAIN )
					, $this->required_version
					, get_bloginfo( 'version' )
					, admin_url( 'update-core.php' )
				)
			);
		} else {
			return true;
		};
	}

}
?>