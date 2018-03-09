<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package magic
 */

?></div><!-- .row -->
</div><!-- #content -->

<footer id="colophon" class="site-footer">
<div class="site-info container">
	<div class="ABOUT row">
		<?php get_sidebar('footer'); ?>
	</div>
</div>
<!-- .site-info -->
</footer>
<!-- #colophon -->
</div>
<!-- #boxed-all -->
</div>
<!-- #main-wrapper -->

<?php wp_footer(); ?></body>
</html>