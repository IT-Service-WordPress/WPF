<table class="form-table">
	<tbody><?php
		foreach ( $this->controls as $control ) { ?>
		<tr>
			<th scope="row"><?php
				if ( $control->get_id() && $control->get_label() ) {
					?><label for="<?php echo esc_attr( $control->get_id() ); ?>"><?php echo esc_html( $control->get_label() ); ?></label><?php
				}; ?>
			</th>
			<td><?php
				$control->display();
			?></td>		
		</tr><?php
		};
	?></tbody>
</table>