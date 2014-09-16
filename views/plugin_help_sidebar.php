<p><strong><?php _e( 'For more information:' ); ?></strong></p>

<p><?php printf( __( '<a href="%2$s" target="_blank">About plugin</a>', \WPF\v1\WPF_ADMINTEXTDOMAIN ), $this->get_group()->get_plugin()->get_title( false ), $this->get_group()->get_plugin()->get_plugin_uri() ); ?></p>
<p><?php printf( __( '<a href="%2$s" target="_blank">About author</a>', \WPF\v1\WPF_ADMINTEXTDOMAIN ), $this->get_group()->get_plugin()->get_author_name( false ), $this->get_group()->get_plugin()->get_author_uri() ); ?></p>