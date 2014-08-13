<?php
	foreach ( $this->controls as $control ) { ?>
		<p><?php
			if ( $control->get_id() && $control->get_label() ) {
				?><label for="<?php echo esc_attr( $control->get_id() ); ?>"><?php echo esc_html( $control->get_label() ); ?></label><?php
			};
			$control->display();
		?></p><?php
	};
?>