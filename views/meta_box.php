<?php
	\ob_start();
	foreach ( $this->get_controls() as $control ) {
		$data_manipulator = $control;
?>
		<p><strong><label for="<?php echo esc_attr( $control->get_id() ); ?>"><?php echo $control->get_label(); ?></label></strong></p>
<?php
		$control->display();
	};
	echo \ob_get_clean();
?>