<div class="<?php echo $this->message_type ?>">
<?php
	foreach ( (array) $this->message as $message ) {
?>
	<p><?php echo $message; ?></p>
<?php
	};
?>
</div>