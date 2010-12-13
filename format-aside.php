<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="entry-summary">
			<?php the_excerpt( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'justcss' ) ); ?>
		</div><!-- .entry-summary -->
		<footer class="entry-meta">
					<?php printf( __( '<a href="%1$s" title="Permalink" rel="bookmark"><time class="entry-date" datetime="%2$s" pubdate>%3$s</time></a>', 'justcss' ),
						get_permalink(),
						get_the_date( 'c' ),
						get_the_date()
					); ?>
		<?php if(! is_single()): ?>
			<span class="meta-sep"> | </span>
			<?php the_tags( '<span class="tag-links">' . __( 'Tagged ', 'justcss' ) . '</span>', ', ', '<span class="meta-sep"> | </span>' ); ?>
			<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'justcss' ), __( '1 Comment', 'justcss' ), __( '% Comments', 'justcss' ) ); ?></span>
		<?php endif; ?>
			<?php edit_post_link( __( 'Edit', 'justcss' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
		</footer><!-- #entry-meta -->
	</article><!-- #post-<?php the_ID(); ?> -->
