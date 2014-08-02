<div class="<?php echo sanitize_html_class( $this->message_type ) ?>">
<?php
	foreach ( (array) $this->message as $message ) {
?>
	<p><?php force_balance_tags ( $message ); ?></p>
<?php
	};
?>
</div>