
<?php
/*
Template Name: Шаблон Мастер
Template Post Type: post, page
*/

get_header(); ?>

<?php if ( is_active_sidebar( 'sidebar-1' ) ) {

}?>

<div id="primary" class="content-area col ">


<div class="b-geo-target">
	<span class="b-geo-target__description">Ваш город:  </span>
	<div class="b-geo-target__content">
		<div class="b-geo-target__header">Москва</div>
		<ul class="b-geo-target__munu ">
			<a rel="nofollow" href="/?wt_city_by_default=Москва">Москва</a>
			<a rel="nofollow" href="/?wt_region_by_default=Рязань">Рязань</a>
			<a rel="nofollow" href="/?wt_region_by_default=Владимир">Владимир</a>
		</ul>
	</div>

</div>
	<?php GetInstagram(); ?>
	<a href="#" class="eModal-1">Open Modal</a>
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
