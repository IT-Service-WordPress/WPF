<input id="<?php echo esc_attr( $this->get_id() ); ?>" name="<?php echo esc_attr( $this->get_name() ); ?>" class="small-text" type="number" value="<?php echo esc_attr( $this->get_value() ); ?>"></input><?php
	if ( $this->get_postfix() ) { 
		echo ' ' . $this->get_postfix();
	};
	if ( $this->get_description() ) { ?>
	<p class="description"><?php echo $this->get_description(); ?></p>
	<?php };
?>