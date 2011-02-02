<?php
/**
 * @package WordPress
 * @subpackage JustCSS
 */
?>
<?php do_action( 'justcss_loop_start' ); ?>
<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if ( $wp_query->max_num_pages > 1 ) : ?>
	<nav id="nav-above">
		<h1 class="section-heading"><?php _e( 'Post navigation', 'justcss' ); ?></h1>
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'justcss' ) ); ?></div>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'justcss' ) ); ?></div>
	</nav><!-- #nav-above -->
<?php endif; ?>
<?php /* Start the Loop */
while ( have_posts() ) : the_post();
if ( function_exists( 'get_post_format' ) ) {
	if ( get_post_format() ):
		get_template_part( 'format', get_post_format() );
	else:
	get_template_part( 'format', 'standard' );
	endif;
} else {
	get_template_part( 'format', 'standard' );
}
endwhile; ?>
<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
	<nav id="nav-below">
		<h1 class="section-heading"><?php _e( 'Post navigation', 'justcss' ); ?></h1>
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'justcss' ) ); ?></div>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'justcss' ) ); ?></div>
	</nav><!-- #nav-below -->
<?php endif; ?>
<?php do_action( 'justcss_loop_end' ); ?>