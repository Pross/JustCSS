<?php
/**
 * default footer
 */
function justcss_footer_default() {
	$footer = '				<a href="http://wordpress.org/" title="' .  __( 'A Semantic Personal Publishing Platform', 'justcss' ) . '" rel="generator">' . __( 'Proudly powered by WordPress', 'justcss' ) . '</a>';
	echo apply_filters( 'justcss_footer_filter', $footer );
}

