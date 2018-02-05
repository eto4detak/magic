<?php
/*========================================================
		*	 авто зазаз
		========================================================*/

$order=wc_create_order(); //создаём новый заказ
/*$order=new WC_Order('0'); //создаём новый заказ*/
//Записываем в массив данные о доставке заказа и данные клиента
$address = array(
        'first_name' => '$first_name',
        'last_name'  => '$last_name',
        'company'    => '',
        'email'      => '$email',
        'phone'      => '',
        'address_1'  => '$adress_one',
        'address_2'  => '$adress_two', 
        'city'       => '$city',
        'state'      => '',
        'postcode'   => '$postcode',
        'country'    => ''
    ); 


$product = new WC_Product();
$product->set_name('Super Product');
$product->set_sku('set_sku');



		if ( $product ) {
			$default_args = array(
				'name'         => $product->get_name(),
				'tax_class'    => $product->get_tax_class(),
				'product_id'   => $product->is_type( 'variation' ) ? $product->get_parent_id() : $product->get_id(),
				'variation_id' => $product->is_type( 'variation' ) ? $product->get_id() : 0,
				'variation'    => $product->is_type( 'variation' ) ? $product->get_attributes() : array(),
				'subtotal'     => wc_get_price_excluding_tax( $product, array( 'qty' => $qty ) ),
				'total'        => wc_get_price_excluding_tax( $product, array( 'qty' => $qty ) ),
				'quantity'     => $qty,
			);
		} else {
			$default_args = array(
				'quantity'     => $qty,
			);
		}

		$args = wp_parse_args( $args, $default_args );

		// BW compatibility with old args
		if ( isset( $args['totals'] ) ) {
			foreach ( $args['totals'] as $key => $value ) {
				if ( 'tax' === $key ) {
					$args['total_tax'] = $value;
				} elseif ( 'tax_data' === $key ) {
					$args['taxes'] = $value;
				} else {
					$args[ $key ] = $value;
				}
			}
		}

		$item = new WC_Order_Item_Product();
		$item->set_props( $args );
		$item->set_backorder_meta();
		$item->set_order_id( 0 );
		$item->save();
		$order->add_item( $item );
		wc_do_deprecated_action( 'woocommerce_order_add_product', array( 0, 0 ,$product, $qty, $args ), '3.0', 'woocommerce_new_order_item action instead' );
/* $order=>set_address( $address, 'billing' ); //Добавляем данные о доставке
 $order=>set_address( $address, 'shipping' ); // и оплате
 $order=>calculate_totals(); //подбиваем сумму и видим что наш заказ появился в админке*/

/*========================================================
		*		end авто закза
		========================================================*/