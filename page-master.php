
<?php
/*
Template Name: Шаблон Мастер
Template Post Type: post, page
*/

get_header(); ?>

<?php if ( is_active_sidebar( 'sidebar-1' ) ) {

}?>



<?php function vardump($var) {
  echo '<pre>';
  var_dump($var);
  echo '</pre>';
}
	$attachments = get_children( array(
		'post_parent'    => 975,
		'order'          => 'ASC',
		'post_mime_type' => 'image',
		'post_type'      => 'attachment',
	) );

	$args = array( 
	    'post_type' => array( 'product', ),
	    'posts_per_page' => -1,                 
	);

	$the_query = new WP_Query( $args );
	if ( $the_query->have_posts() ) :
	while ( $the_query->have_posts() ) : $the_query->the_post();

		//get_id_woocom($product);
	endwhile;
	endif;
	wp_reset_postdata();

	function get_id_woocom($product_woo)
	{
		$number_id = $product_woo->get_id();
		$product_image_gallery = get_post_meta( $number_id, '_product_image_gallery', true );
		$attachments         = array_filter( explode( ',', $product_image_gallery ) );
		$media = get_post_thumbnail_id( $number_id );
		$attachments = array_diff($attachments, array($media));
		
		$media = wp_get_attachment_image_url( 973);
	  $exp = '.' .	end(explode(".", $media));
	  vardump( $product_woo->name . $exp);
		//$this->core->rename( $media, $product_woo->name . $exp );

		 $counter = 2;
		 foreach ($attachments as  $attach) {
		 	if($counter > 10) $counter = $counter;
		 	else $counter =  '0' . $counter;
		 	vardump( $product_woo->name . '-' . $counter . $exp);
		 	// $this->core->rename( $attach, $product_woo->name . '-' . $counter . $exp);
		 	$counter++;
		 }
	}

	//получить мета поля карбон плагин
	$args = array(
		'taxonomy' => 'product_cat',
		'hide_empty' => false,
	);
	$terms = get_terms( $args );
	foreach ($terms as $key => $value) {
	// echo	$value->slug;
	// echo	$value->term_id;
	 // /$address_lines = carbon_get_theme_option('crb_addresses', 'complex');
	// var_dump( carbon_get_term_meta( $value->term_id, 'crb_exclude_cat' ));
	 //echo	' ';
	}
	//var_dump($terms);
?>
<?php 

 ?>
	<a href="#" class="eModal-1">Open Modal</a>
	<!-- получить города по API -->
	<?php echo GetPolis("бре"); ?>
	<main id="main" class="site-main container">
		 <?php  $args = array(
		'posts_per_page' => '40',
		'post_type' => 'product',
		'order' => 'ASC'
		); ?>

		<?php $loop = new WP_Query( $args ); ?> 
		<?php 	if($loop->have_posts()) :?>
			<div  class="owl-carousel owl-theme">
				<?php $sum = 1; $count = 1; ?>
				<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
					<?php if($count===1) : ?>
					<div class="item">
						<?php 




						 ?>
					<?php endif; ?>
					<?php global $product; ?>
					<?php $p_ids[] = $product->get_id(); 
					wc_get_template_part( 'content', 'product' );?>

			 		<?php if($count===$sum) :?>
			 			</div>
						<?php $count = 1; ?>
						<?php else :$count++; 
					endif; ?>
					<?php endwhile;wp_reset_postdata(); ?>
					<?php if($count!==1) : ?>
					</div>
					<?php endif; ?>
			</div>
		<?php endif;?>

		<?php while ( have_posts() ) : the_post();?>
			<?php the_content();?>
		<?php endwhile; ?>
		<div id="content-box" class="">
			<?php $col = is_active_sidebar( 'sidebar-1' ) ?  'col-md-8 col-lg-9 col-xl-10' : ''; ?>
			<?php echo  do_shortcode( '[products class="content-ar '  . '" ' . 'ids=' . implode(',', $p_ids) . ']') ?>
			<?php get_sidebar(); ?>
		</div>


	</main><!-- #main -->
</div><!-- #primary -->
<?php 
get_footer();
