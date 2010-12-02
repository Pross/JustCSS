<?php
/**
 * @package WordPress
 * @subpackage JustCSS
 */
get_header(); ?>
		<section id="primary">
			<div id="content">
			<?php if ( have_posts() ) : ?>
				<header class="page-header">
					<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'justcss' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				</header>
				<?php get_template_part( 'loop', 'search' ); ?>
			<?php else : ?>
				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'justcss' ); ?></h1>
					</header><!-- .entry-header -->
					<div class="entry-content">
						<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'justcss' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->
			<?php endif; ?>
			</div><!-- #content -->
		</section><!-- #primary -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>