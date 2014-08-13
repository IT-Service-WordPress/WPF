<input id="<?php echo esc_attr( $this->get_id() ); ?>" name="<?php echo esc_attr( $this->get_option_name() ); ?>" class="regular-text" type="text" value="<?php echo esc_attr( $this->get_option_value() ); ?>"></input><?php
	if ( $this->get_description() ) { ?>
	<p class="description"><?php echo $this->get_description(); ?></p>
	<?php };
?>