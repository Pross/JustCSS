<?php
/**
 * load the theme function files
 */
locate_template( array( 'functions/justcss_functions.php' ), true );
locate_template( array( 'functions/cpanel.php' ), true );
locate_template( array( 'functions/filters.php' ), true );

/**
 * Add a custom footer with our justcss_footer_filter
 */
add_filter('justcss_footer_filter', 'footer_add_version');
function footer_add_version( $footer ) {
	$footer .= '<div class="justcss_footer_class"><span class="entry-meta"><a href="http://pross.org.uk/2010/07/25/justcss/">JustCSS</a></span> v' . JCSS_VERSION . ' by Pross</div>';
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