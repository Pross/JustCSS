<?php
require_once( 'functions/justcss_functions.php' );
require_once( 'functions/cpanel.php' );
require_once( 'functions/filters.php' );


add_filter('jcss_footer_filter', 'footer_add_version');
function footer_add_version( $footer ) {
$footer .= '<div class="justcss_footer_class"><span class="entry-meta"><a href="http://www.pross.org.uk/themes/">JustCSS</a></span> v' . JCSS_VERSION . ' by Pross</div>';
return $footer;
}
