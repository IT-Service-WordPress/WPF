<?php 

namespace WPF\v1\Plugin\Component;

require_once ( 'wpf_inc.php' );
require_once ( 'wpf_plugin_component_dynamic.php' );
require_once ( 'wpf_gui_notice_admin.php' );

/*

@since 1.0.0

@package   Wordpress plugin framework
@author    Sergey S. Betke <Sergey.S.Betke@yandex.ru>
@license   GPL-2.0+
@copyright 2014 ООО "Инженер-53"
*/
class ToDo
	extends
		Dynamic
{

	protected
	$message;

	protected
	$show_on_pages;

	protected
	$capability;

	protected
	$target_on_pages;

	public
	function __construct(
		$message
		, $show_on_pages = null
		, $capability = null
		, $target_on_pages = null
	) {
		parent::__construct();
		$this->message = $message;
		$this->show_on_pages = (array) $show_on_pages;
		$this->capability = $capability;
		$this->target_on_pages = (array) $target_on_pages;
	}

	public
	function __sleep() {
		return array( 'message', 'show_on_pages', 'capability', 'target_on_pages' );
			
	}

	public
	function __wakeup() {
	}

	public
	function bind_action_handlers_and_filters() {
		parent::bind_action_handlers_and_filters();
		
		$actions = array();
		if ( $this->show_on_pages ) {
			foreach( (array) $this->show_on_pages as $page_slug ) {
				$actions[] = 'load-' . $page_slug;
			};
		} else {
			$actions[] = 'admin_init';
		};
		foreach( $actions as $action ) {
			\add_action( $action, array( &$this, 'schedule_notice' ) );
		};
		
		$actions = array();
		if ( $this->target_on_pages ) {
			foreach( (array) $this->target_on_pages as $page_slug ) {
				$actions[] = 'load-' . $page_slug;
			};
		};
		foreach( $actions as $action ) {
			\add_action( $action, array( &$this, 'remove_notice' ) );
		};
	}

	public
	function schedule_notice() {
		if (
			$this->capability
			&& \current_user_can( $this->capability )
		) {
			new \WPF\v1\GUI\Notice\Admin(
				$this->message
				, 'updated'
			);
		};
	}

	public
	function remove_notice() {
		if (
			$this->capability
			&& \current_user_can( $this->capability )
		) {
			$this->unbind();
		};
	}

}
?>