
<?php
/*
Template Name: ТЕСТОВАЯ СТРАНИЦА
Template Post Type: post, page
*/

get_header();
if( is_page_template( 'page-test.php' )) echo "<div>11111</div>";


 ?>

<input type='file' accept='text/plain' onchange='openFile(event)'><br>
<img id='output'>
<script>

</script>



<?php
get_sidebar();
get_footer();
