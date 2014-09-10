<fieldset>
	<input id="<?php echo esc_attr( $this->get_id() ); ?>" name="<?php echo esc_attr( $this->get_name() ); ?>" type="checkbox" <?php if ( $this->get_value() ) { ?>checked="checked" <?php }; ?>value="true"></input>
	<?php if ( $this->get_description() ) { ?>
		<p class="description"><?php echo $this->get_description(); ?></p>
	<?php }; ?>
</fieldset>