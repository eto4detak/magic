	<?php 
	## Отображает метабокс на странице редактирования поста
	public function render_metabox( $post ) {

		?>
		<table class="form-table company-info">

			<tr>
				<th>
					Адреса компании <span class="dashicons dashicons-plus-alt add-company-address"></span>
				</th>
				<td class="company-address-list">
					<?php
					$input = '
					<span class="item-address">
						<input type="text" name="'. self::$meta_key .'[]" value="%s">
						<span class="dashicons dashicons-trash remove-company-address"></span>
					</span>
					';

					$addresses = get_post_meta( $post->ID, self::$meta_key, true );

					if ( is_array( $addresses ) ) {
						foreach ( $addresses as $addr ) {
							printf( $input, esc_attr( $addr ) );
						}
					} else {
						printf( $input, '' );
					}
					?>
				</td>
			</tr>

		</table>

		<?php
	}