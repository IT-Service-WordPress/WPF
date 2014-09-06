<fieldset>
	<legend class="screen-reader-text"><span><?php echo esc_html( $this->get_label() ); ?></span></legend>
<?php 
	foreach( $this->choices as $value => $label ) {
?>
	<label>
		<input id="<?php echo esc_attr( $this->get_id() ); ?>" name="<?php echo esc_attr( $this->get_option_name() ); ?>" type="radio" <?php checked( $this->get_option_value(), $value ); ?> value="<?php echo esc_attr( $value ); ?>"></input>
		<span><?php echo esc_html( $label ); ?></span>
	</label>
	<br/>
<?php 
	};
	if ( $this->get_description() ) {
?>
		<p class="description"><?php echo $this->get_description(); ?></p>
<?php
	};
?>
</fieldset>