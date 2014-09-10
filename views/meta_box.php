<?php
	\ob_start();
	$this->meta_fields();
	echo \ob_get_clean();
?>