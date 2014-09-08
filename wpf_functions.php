<?php 

namespace WPF\v1;

/*
WPF functions.

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/

function trigger_wpf_error(
	$error_msg
	, $error_type = E_USER_NOTICE
) {
	if (
		\WP_DEBUG
		&& \is_admin()
	) {
		require_once( 'wpf_gui_notice_admin.php' );
		new \WPF\v1\GUI\Notice\Admin(
			$error_msg
			, 'error'
		);
	};
	return trigger_error(
		$error_msg
		, $error_type
	);
};

?>