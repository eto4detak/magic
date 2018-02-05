<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head>
section and everything up until
<div id="content">
	*
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package magic
 */

?>
	<!doctype html>
	<html <?php language_attributes(); ?>
		>
<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>
		">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">

		<?php wp_head(); ?></head>

<body <?php body_class(); ?>
		>
		<div id="main-wrapper" class="main-wrapper">
			<a class="skip-link screen-reader-text" href="#content">
				<?php esc_html_e( 'Skip to content', 'magic' ); ?></a>
			<div class="wrapper" id="boxed-all">
				<header id="masthead" class="site-header">
					<div class="top-bar">
						<div class=" head-option m-row">
							<div class="info m-row">
								<div class="box-phone">
									<i class="fa fa-phone"></i>
									<?php $address = get_option('magic_options_address')? get_option('magic_options_address') :'';
									 if($address !== '' )	{?>
									<div class="contents">
										<p><?php echo  $address[0] ?></p>
									</div>
									<?php } ?>
								</div>
								<?php 
									$emails = carbon_get_theme_option('crb_contact_address', 'complex');
									if($emails = $emails[0]['email']): ?>
								<div class="email"> <i class="fa fa-envelope"></i>
									<a href="mailto:<?php echo $emails ?>"><?php echo $emails ?></a>
								</div>
							<?php endif ?>
							</div>
							<!-- #box-phone -->
							<div class="settings m-row">
								<?php 
								$currencys = carbon_get_theme_option('magic_currency', 'complex');
								if($currencys[0]['mini_сurrency']) { ?>
								<div class="currency m-row">
									<span><?php _e('Currency','magic') ?> :</span>
									<a class="dropdown-toggle" ><span><?php echo $currencys[0]['mini_сurrency'];?></span><span class="caret"></span>
										<ul class="dropdown-menu">
										<?php
										foreach ($currencys as $currency) {
											echo '<li data-value=\'' . $currency['mini_сurrency'] . '\'>' . $currency['сurrency']  . '</li>';
									} ?>
									</ul>
									</a>

								</div>
								<?php }?>

							</div>
								<?php 
								$lang = carbon_get_theme_option('magic_language', 'complex');
								if($lang[0]) { ?>
							<div class="location m-row">
									<a class="dropdown-toggle" ><span><?php echo $lang[0]['language'];?></span><span class="caret"></span>
										<ul class="dropdown-menu">
										<?php
										foreach ($lang as $la) {
											echo '<li data-value=\'' . $la['language'] . '\'>' . $la['language']  . '</li>';
									} ?>
									</ul>
									</a>

							</div>
								<!-- #location -->
								<?php }?>

							</div>
							<!-- #settings -->

										<?php 
								$fb = carbon_get_theme_option('url_fb');
								$vk = carbon_get_theme_option('url_vk');
								$tw = carbon_get_theme_option('url_tw');
								$sk = carbon_get_theme_option('url_sk');
								$lin = carbon_get_theme_option('url_lin');
								if($fb || $tw || $vk || $sk || $lin) : ?>
								<div class="social m-row">
									<ul class="social-icon">
										<?php if($fb): ?><li><a href=" <?php echo $fb ?> " target="_blank"><i class="fa fa-twitter"></i></a></li><?php endif;if($tw) : ?>
									<li>
										<a href="<?php echo $tw ?>" target="_blank">
											<i class="fa fa-flickr"></i>
										</a>
									</li>
								<?php endif;if($vk) : ?>
									<li>
										<a href="<?php echo $vk ?>" target="_blank">
											<i class="fa fa-facebook-square"></i>
										</a>
									</li>
								<?php endif;if($sk) : ?>
									<li>
										<a href="<?php echo $sk ?>" target="_blank">
											<i class="fa fa-skype"></i>
										</a>
									</li>
										<?php endif;if($lin) :?>
									<li>
										<a href="<?php echo $lin ?>" target="_blank">
											<i class="fa fa-linkedin"></i>
										</a>
									</li>
								<?php endif; ?>
								</ul>
								</div>
								<!-- #social -->
								<?php endif;?>
							<!-- #row -->
						</div>
						<!-- #container -->
					</div>
					<!-- #top-bar -->
					<div class="menu-bar m-row">
						<div class="site-branding m-row">
							<?php
							the_custom_logo();
							if ( is_front_page() && is_home() ) : ?>
							<div class="logo-description">
								<h1 class="site-title">
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>
										" rel="home">
										<?php bloginfo( 'name' ); ?></a>
								</h1>
								<?php else : ?>
								<div class="logo-description">
								<p class="site-title">
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>
										" rel="home">
										<?php bloginfo( 'name' ); ?></a>
								</p>
							
								<?php endif;

							$description = get_bloginfo( 'description', 'display' );
							if ( $description || is_customize_preview() ) : ?>
								<p class="site-description">
									<?php echo $description; /* WPCS: xss ok. */ ?></p>
								<?php
							endif; ?>

							</div>
						<!-- #logo-description -->
						</div>
						<!-- .site-branding -->

						<nav id="site-navigation" class="main-navigation">
							<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
								<?php esc_html_e( 'Primary Menu', 'magic' ); ?></button>
							<?php
							wp_nav_menu( array(
								'theme_location' =>
							'menu-1',
								'menu_id'        => 'primary-menu',
							) );
							?>
						</nav>
						<!-- #site-navigation -->
						<div class="pull-right m-row">
							<?php get_search_form(); ?>
							<a href="непоиск">непоиск</a>
							<?php do_action( 'magic_header'); ?>
						</div>
						<!-- #pull-right -->
					</div>
					<!-- #menu-bar -->
				</header>
				<!-- #masthead -->
				<div id="content" class="site-content">

					<!--для разработчика -->

					<script type="text/javascript">
	<?php if($templ = get_page_template_slug( $post->ID )){ ?>
		console.log('template = <?php echo  $templ; ?>');
	<?php }else{ ?>
		console.log('template = no');
	<?php } ?></script>
	<?php function vardump($var) {
	  echo '<pre>';
	  var_dump($var);
	  echo '</pre>';
	} ?>