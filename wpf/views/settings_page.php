<div class="wrap"> 
	<h2><?php echo \esc_html( $this->get_page_title() ); ?></h2> 
	<form action="<?php echo \self_admin_url( 'options.php' ); ?>" method="post" enctype="multipart/form-data"> 
	<?php
		\ob_start(); 
		\settings_fields( $this->get_page_slug() ); 
		\do_settings_sections( $this->get_page_slug() ); 
		\submit_button();
		echo \ob_get_clean();
	?>
	</form>
</div>