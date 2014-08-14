<p><strong><?php _e( 'For more information:' ); ?></strong></p>

<p><?php printf( __( '<a href="%2$s" target="_blank">About plugin</a>', \WPF\v1\WPF_ADMINTEXTDOMAIN ), $this->plugin->get_title( false ), $this->plugin->get_plugin_uri() ); ?></p>
<p><?php printf( __( '<a href="%2$s" target="_blank">About author</a>', \WPF\v1\WPF_ADMINTEXTDOMAIN ), $this->plugin->get_author_name( false ), $this->plugin->get_author_uri() ); ?></p>