
<?php
/*
Template Name: Шаблон Мастер
Template Post Type: post, page
*/

get_header(); ?>
<div id="primary" class="content-area">
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
			<div class="entry-content">
			<?php the_content();?>
			</div>
		<?php endwhile; ?>

		<h1>[products]</h1>
		<?php echo  do_shortcode( '[products ids=' . implode(',', $p_ids) . ']') ?>
	</main><!-- #main -->
</div><!-- #primary -->
<?php get_footer();
