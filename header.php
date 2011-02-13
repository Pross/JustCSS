<?php
/**
 * @package WordPress
 * @subpackage JustCSS
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;
	wp_title( '|', true, 'right' );
	// Add the blog name.
	bloginfo( 'name' );
	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";
	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'justcss' ), max( $paged, $page ) );
	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="page" class="hfeed">
	<header id="branding">
			<hgroup><?php do_action( 'justcss_logo' ); ?>		
				<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
			</hgroup>
			<?php do_action('justcss_header_before_nav'); ?>
			<nav id="access" role="navigation">
				<h1 class="section-heading"><?php _e( 'Main menu', 'justcss' ); ?></h1>
				<div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'justcss' ); ?>"><?php _e( 'Skip to content', 'justcss' );
?></a></div>

				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
			</nav><!-- #access -->
		 <?php do_action('justcss_header_after_nav'); ?>
	</header><!-- #branding -->
	<div id="main">