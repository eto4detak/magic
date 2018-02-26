
<?php
/*
Template Name: Оформление заказа
Template Post Type:  page
*/

   
get_header(); ?>

	<div id="primary" class="content-area col-md-8 col-lg-9 col-xl-10">
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
