<?php
global $shortname;
header('Content-type: text/css');
header("Cache-Control: max-age=604800, public, must-revalidate");
$offset = 372000 ;
$ExpStr = 'Expires: ' . gmdate('D, d M Y H:i:s', time() + $offset) . ' GMT';
header($ExpStr);
$settings = get_option($shortname.'_options');
if ($settings['jcss_brackets'] === 'Yes'):
echo"#site-title a:before{content:'{'}\n#site-title a:after{content:'}'}";
endif;
if ($settings['jcss_bpo'] === 'Yes'):
echo "\n.bypostauthor { background-color: " . $settings['jcss_bypostauthor'] . '!important}';
endif;
// Variables should be added with {} brackets
echo <<<CSS
\n#site-title a, .nav-next a, .nav-previous a, .entry-meta a, a, #page {
color: {$settings['jcss_mainfont']};
}
#access {
background-color: {$settings['jcss_nav']};
}
.widget-area {
background-color: {$settings['jcss_widget']};
}
ol.commentlist li.even{
background-color: {$settings['jcss_even']};
}
ol.commentlist li.odd{
background-color: {$settings['jcss_odd']};
}
#page, #justcss_footer_div {
width: {$settings['jcss_width']}px;
}
.sticky {
background-color: {$settings['jcss_sticky']};
-webkit-border-radius:{$settings['jcss_corner']}px;
-moz-border-radius:{$settings['jcss_corner']}px;
border-radius:{$settings['jcss_corner']}px;
}
ol.commentlist li.odd,ol.commentlist li.even {
-webkit-border-radius: {$settings['jcss_corner']}px;
-moz-border-radius:{$settings['jcss_corner']}px;
border-radius: {$settings['jcss_corner']}px;
}
.widget-area{
-webkit-border-radius:{$settings['jcss_corner']}px;
-moz-border-radius:{$settings['jcss_corner']}px;
border-radius:{$settings['jcss_corner']}px;
}
#access{
-webkit-border-radius:{$settings['jcss_corner']}px;
-moz-border-radius:{$settings['jcss_corner']}px;
border-radius:{$settings['jcss_corner']}px;}
CSS;
//More php can go here
echo <<<CSS
CSS;
?>