<?php 
/*
Template Name: Webhooks
Template Post Type:  page
*/

echo get_option( 'super_options');
$_POST = json_decode(file_get_contents('php://input'), true);

update_option( 'super_options', $_POST['name'] );

 ?>