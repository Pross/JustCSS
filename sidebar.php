<?php
/**
 * @package WordPress
 * @subpackage JustCSS
 */
?>
		<div id="secondary" class="widget-area">
			<?php if ( ! dynamic_sidebar( 'sidebar' ) ) : ?>
				<aside id="search" class="widget widget_search">
					<?php get_search_form(); ?>
				</aside>
				<aside id="archives" class="widget">
					<h1 class="widget-title"><?php _e( 'Archives', 'justcss' ); ?></h1>
					<ul>
						<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
					</ul>
				</aside>
				<aside id="meta" class="widget">
					<h1 class="widget-title"><?php _e( 'Meta', 'justcss' ); ?></h1>
					<ul>
						<?php wp_register(); ?>
						<aside><?php wp_loginout(); ?></aside>
						<?php wp_meta(); ?>
					</ul>
				</aside>
			<?php endif; // end sidebar widget area ?>
		</div><!-- #secondary .widget-area -->