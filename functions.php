<?php
include('functions/justcss_functions.php');
include('functions/cpanel.php');
require('functions/filters.php');


add_filter('jcss_footer_filter', 'footer_add_version');
function footer_add_version( $footer ) {
$footer .= '<div class="justcss_footer_class"><span class="entry-meta"><a href="http://www.pross.org.uk/themes/">JustCSS</a></span> v' . JCSS_VERSION . ' by Pross</div>';
return $footer;
}
