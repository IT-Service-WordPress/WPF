<?php 

namespace WPF\v1\Option;

require_once ( 'wpf_inc.php' );
require_once ( 'wpf_option_common.php' );

/*
Plugin option descriptor class.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class PluginOption
	extends
		Common
{

	protected
	$option_name;

	public
	function __construct(
		$id // option name without plugin prefix
		, $value = null
		, $autoload = true
	) {
		parent::__construct(
			$id
			, $value
			, $autoload
		);
	}

	public
	function get_option_name() {
		if ( ! $this->option_name ) {
			$this->option_name = $this->plugin->get_namespace() . '-' . $this->option_id;
		};
		return $this->option_name;
	}

	public
	function install() {
		parent::install();
	}

	public
	function uninstall() {
		\delete_option(
			$this->get_option_name()
		);
		// !!!! netwotk wide ? !!!! delete_site_option
	}

}
?>