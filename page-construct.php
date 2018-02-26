<?php
/*
Template Name: Конструктор
Template Post Type: post, page
*/

get_header();
?>

		<iframe src="https://cosuv.ru/app/2556" style="width:100%;height:600px;position:relative;" frameborder="0" allowfullscreen=""></iframe>
		<script type="text/javascript">
		window.addEventListener('message', function(e){
		var data = {
			action: 'c_add_product',
			constructData: e.data,
			nonce_code : myajax.nonce
		};
		jQuery.post( myajax.url, data, function(response) {
			jQuery( document.body ).trigger( 'updated_wc_div' );
		});

		});
		</script>
		<!-- $( document.body ).on( 'wc_fragment_refresh updated_wc_div', function() { -->
	<div id="primary" class="content-area col-md-8 col-lg-9 col-xl-10">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post();

				do_action( 'storefront_page_before' );

				get_template_part( 'content', 'page' );

				/**
				 * Functions hooked in to storefront_page_after action
				 *
				 * @hooked storefront_display_comments - 10
				 */
				do_action( 'storefront_page_after' );

			endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
do_action( 'storefront_sidebar' );
get_footer();
