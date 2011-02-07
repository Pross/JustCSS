<?php
/**
 * load the theme function files
 */
load_template( TEMPLATEPATH . '/functions/justcss_functions.php' );
load_template( TEMPLATEPATH . '/functions/cpanel.php' );
load_template( TEMPLATEPATH . '/functions/filters.php' );

/**
 * Add a custom footer with our justcss_footer_filter
 */
add_filter('justcss_footer_filter', 'footer_add_version');
function footer_add_version( $footer ) {
	$footer .= '<div class="justcss_footer_class"><span class="entry-meta"><a href="http://www.pross.org.uk/themes/">JustCSS</a></span> v' . JCSS_VERSION . ' by Pross</div>';
	return $footer;
}

/**
 * Lets add a font to the font list in the JustCSS contol page.
 */
add_filter( 'justcss_google_fonts', 'add_my_font' );
function add_my_font( $fonts ) {
	 $fonts[] = 'Coming Soon';
	 return $fonts;
}