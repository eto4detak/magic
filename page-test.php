
<?php
/*
Template Name: ТЕСТОВАЯ СТРАНИЦА
Template Post Type: post, page
*/

get_header();
if( is_page_template( 'page-test.php' )) echo "<div>11111</div>";
 ?>
 <iframe src="banner.html" width="468" height="60" align="left">
    Ваш браузер не поддерживает плавающие фреймы!
 </iframe>

<?php
get_sidebar();
get_footer();
