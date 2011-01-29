<?php
add_action( 'jcss_footer', 'jcss_footer_default' );

$data = get_theme_data( TEMPLATEPATH . '/style.css' );
define( 'JCSS_VERSION', $data[ 'Version' ] );

add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );
add_theme_support( 'post-thumbnails' );
add_custom_background();
add_editor_style( 'css/editor-style.css' );
load_theme_textdomain( 'justcss', TEMPLATEPATH . '/languages' );

add_filter( 'the_content', 'add_thumbs' );
add_action( 'wp_head', 'justcss_css', 1 );
add_action( 'init','show_bar', 1 );
add_image_size( 'random-thumb', 125, 125 );
add_action( 'wp_head', 'ie_stuff' );
add_action('wp_head', 'jcss_do_css');

function jcss_do_css() {
	$options = get_option('jcss_options');
	echo ( isset( $options['jcss_google_fonts'] ) && isset( $options['main_font'] ) ) ? '<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=' . str_replace( ' ', '+', $options['main_font'] ) . '">' : '';
	echo "<style type=\"text/css\">";
	echo ( isset( $options['jcss_google_fonts'] ) && isset( $options['main_font'] ) ) ? "body { font-family: '{$options['main_font']}', serif;}" : '';
	if ($options['brackets'] === 'Yes') echo "#site-title a:before{content:'{'} #site-title a:after{content:'}'}";

	if ($options['bpo'] === 'Yes') echo ".bypostauthor { background-color: #" . $options['bypostauthor'] . '!important}';

	if ($options['nav_col'] === 'JustCSS') echo "#access li:hover > a, #access ul ul :hover > a, #access ul ul a { background:#333; color:#fff; } #access ul ul a:hover { background:#000; }";

	if ($options['nav_col'] === 'Toolbox') echo "#access li:hover > a, #access ul ul :hover > a, #access ul ul a { background: #dedede; } #access ul ul a:hover { background: #cecece; }";

// Variables should be added with {} brackets
echo <<<CSS
#site-title a, .nav-next a, .nav-previous a, .entry-meta a, a, #page { color: #{$options['mainfont']}; } #access { background-color: #{$options['nav']};} .widget-area { background-color: #{$options['widget']}; } ol.commentlist li.even { background-color: #{$options['even']}; } ol.commentlist li.odd { background-color: #{$options['odd']}; } #page, #justcss_footer_div { width: {$options['width']}px; } .sticky { background-color: #{$options['sticky']}; -webkit-border-radius:{$options['corner']}px; -moz-border-radius:{$options['corner']}px; border-radius:{$options['corner']}px; } ol.commentlist li.odd, ol.commentlist li.even { -webkit-border-radius: {$options['corner']}px; -moz-border-radius:{$options['corner']}px; border-radius: {$options['corner']}px; } .widget-area { -webkit-border-radius:{$options['corner']}px; -moz-border-radius:{$options['corner']}px; border-radius:{$options['corner']}px; } #access { -webkit-border-radius:{$options['corner']}px; -moz-border-radius:{$options['corner']}px; border-radius:{$options['corner']}px;} .format-aside { -webkit-border-radius:{$options['corner']}px; -moz-border-radius:{$options['corner']}px; border-radius:{$options['corner']}px; background-color: #{$options['aside']};}
CSS;
//More php can go here
echo <<<CSS
CSS;
echo "</style>\n";
}

/**
 * Make theme available for translation
 * Translations can be filed in the /languages/ directory
 */
$locale = get_locale();
$locale_file = TEMPLATEPATH . "/languages/$locale.php";
if ( is_readable( $locale_file ) )
	require_once( $locale_file );

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640;

/**
 * This theme uses wp_nav_menu() in one location.
 */
register_nav_menus( array(
	'primary' => __( 'Primary Menu', 'justcss' ),
) );

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function jcss_page_menu_args($args) {
	$args[ 'show_home' ] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'jcss_page_menu_args' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function jcss_widgets_init() {
	register_sidebar( array (
		'name' => __( 'Sidebar 1', 'justcss' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	register_sidebar( array (
		'name' => __( 'Sidebar 2', 'justcss' ),
		'id' => 'sidebar-2',
		'description' => __( 'An optional second sidebar area', 'justcss' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
}
add_action( 'init', 'jcss_widgets_init' );

function add_thumbs( $content ) {
	the_post_thumbnail( 'thumbnail', array( 'class' => 'alignright shadow' ) );
	return $content;
}

function justcss_css() {
	wp_register_style( 'justcss-firefox', get_template_directory_uri() . '/css/firefox.css', false, JCSS_VERSION );
	wp_register_style( 'justcss-ie', get_template_directory_uri() . '/css/ie.css', false, JCSS_VERSION );
	wp_enqueue_style( 'html5reset', get_template_directory_uri() . '/css/html5reset.css', false, JCSS_VERSION );
	wp_enqueue_style( 'justcss', get_template_directory_uri() . '/css/justcss.css', false, JCSS_VERSION );
	wp_enqueue_style( 'justcss-firefox' );

	if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' );
}

function ie_stuff() {
	wp_enqueue_style( 'justcss-ie' );
	echo '<!--[if lt IE 9]>';
	echo "\r\n" . '<style type="text/css" media="screen">#access, .comment, .widget-area { behavior: url("'. get_template_directory_uri() . '/css/PIE.php");}</style>';
	echo "\r\n" . '<script src="' . get_template_directory_uri() . '/css/html5.js" type="text/javascript"></script>';
	echo "\r\n" . '<![endif]-->' . "\r\n";
}

function show_bar() {
	if ( isset( $_REQUEST[ 'nobar' ] ) && $_REQUEST[ 'nobar' ] == 'yes' ) {
		 define( 'IFRAME_REQUEST', true );
	}
}