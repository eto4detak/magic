<?php 

register_meta( 'product', '_new_opt', array(
	'type'              => 'string',
	'description'       => 'Скидка',
	'single'            => true,
	'sanitize_callback' => null,
	'auth_callback'     => null,
	'show_in_rest'      => false,
) );

add_action( 'woocommerce_product_options_pricing', 'magic_display_panel_add');
function magic_display_panel_add()
{
			woocommerce_wp_text_input( array(
				'id'        => '_new_opt',
				'label'     => __( 'Произвольно для скидок (заменит процент скидки)', 'storefront' ),
				'data_type' => 'string',
			) );
}
add_action( 'woocommerce_process_product_meta', 'magic_woo_custom_fields_save', 10 );
function magic_woo_custom_fields_save( $post_id ) {
   $woocommerce_number_field = $_POST['_new_opt'];
   if ( $woocommerce_number_field ) {
      update_post_meta( $post_id, '_new_opt', esc_attr( $woocommerce_number_field ) );
   }elseif(!empty(get_post_meta($post_id, '_new_opt'))){
   		delete_post_meta($post_id, '_new_opt');
   }

 }



