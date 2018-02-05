
<?php
/*
Template Name: Оформление заказа
Template Post Type:  page
*/

   
get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main container">
						<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

			endwhile; // End of the loop.
			?>
			<?php WC_Checkout::checkout_form_shipping(); ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
