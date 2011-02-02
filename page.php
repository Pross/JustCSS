<?php
/**
 * @package WordPress
 * @subpackage JustCSS
 */
get_header(); ?>
		<div id="primary">
		  <?php do_action( 'justcss_hook_page_before_content' ); ?>
			<div id="content" role="main">
				<?php the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>
					</header><!-- .entry-header -->
					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'justcss' ), 'after' => '</div>' ) ); ?>
					</div><!-- .entry-content -->
					<footer class="entry-meta">
						<?php edit_post_link( __( 'Edit', 'justcss' ), '<span class="edit-link">', '</span>' ); ?>
					</footer>
				</article><!-- #post-<?php the_ID(); ?> -->
				<?php comments_template( '', true ); ?>
			</div><!-- #content -->
		    <?php do_action( 'justcss_hook_page_after_content' ); ?>
		</div><!-- #primary -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>