<?php
/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
$product_id = $product->get_id();
$handle = new WC_Product_Variable($product_id);
$variations1=$handle->get_children();

	//echo '<option  value="'.$value.'">'.implode(" / ", $single_variation->get_variation_attributes()).'-'.get_woocommerce_currency_symbol().$single_variation->price.'</option>';

$attribute_keys = array_keys( $attributes );

do_action( 'woocommerce_before_add_to_cart_form' ); 


foreach ($variations1 as $variation_id) {
	$single_variation = new WC_Product_Variation($variation_id);
	$sku = $single_variation->get_sku();
	$stock_quantity = $single_variation->get_stock_quantity();
	$image_id = $single_variation->get_image_id();
	$thumbnail_url = wp_get_attachment_image_src( $image_id, 'thumbnail' );
	$full_url = wp_get_attachment_image_src( $image_id, 'full' );
	//print_r($thumbnail_url);
	//echo "1111".$thumbnail_url;
	//print_r($single_variation->get_image_id());


?>
<div class="colors2 row woocommerce-product-gallery woocommerce-product-gallery--with-images woocommerce-product-gallery--columns-4 images" data-columns="4" style="opacity: 1; transition: opacity 0.25s ease-in-out;">
	<form class="variations_form cart col-xs-12 col-md-6" method="post" enctype="multipart/form-data">
		<figure class="woocommerce-product-gallery__wrapper"><div class="woocommerce-product-gallery__image">
			<a href="<?php echo $full_url[0]; ?>" class="group">
				<img style="float:left;margin:0 10px 10px 0;" alt="step0682" title="step0682" src="<?php echo $thumbnail_url[0]; ?>" data-src="<?php echo $full_url[0]; ?>" data-large_image_width="<?php echo $full_url[1]; ?>" data-large_image_height="<?php echo $full_url[2]; ?>"  data-large_image="<?php echo $full_url[0]; ?>">
			</a>
			<div class="add_to">
				Цвет: <?php echo $sku; ?><br>
				Артикул: <?php echo $sku; ?><br>
													<select name="quantity" id="quantity" data-sku="<?php echo $sku; ?>" data-color="<?php echo $sku; ?>">
																	<?php for ($i=1;$i<=$stock_quantity;$i++) { ?>
																	<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
																	<?php } ?>
															</select><button type="submit" class="add_to_cart_button button alt">&nbsp;</button>
					<input type="hidden" name="attribute_pa_color" id="attribute_pa_color" value="<?php echo $sku; ?>">
					<input type="hidden" name="add-to-cart" id="add-to-cart" value="<?php echo $product_id; ?>">
					<input type="hidden" name="product_id" id="product_id" value="<?php echo $product_id; ?>">
					<input type="hidden" name="variation_id" id="variation_id" class="variation_id" value="<?php echo $variation_id; ?>">

			</div>
		</div></figure>
	</form>
</div>

<?php 

}
?>

<?php
do_action( 'woocommerce_after_add_to_cart_form' );
