<?php

add_action( 'jcss_footer', 'jcss_footer_default' );

$data = get_theme_data( TEMPLATEPATH . '/style.css' );
define( 'JCSS_VERSION', $data[ 'Version' ] );

add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );
add_theme_support( 'post-thumbnails' );
add_custom_background();
add_editor_style();
load_theme_textdomain( 'justcss', TEMPLATEPATH . '/languages' );

add_filter( 'the_content', 'add_thumbs' );
add_action( 'wp_head', 'justcss_css', 1 );
add_filter( 'rewrite_rules_array', 'wp_insertMyRewriteRules' );
add_filter( 'query_vars', 'wp_insertMyRewriteQueryVars' );
add_filter( 'init', 'flushRules' );
add_filter( 'query_vars', 'add_new_var_to_wp' );
add_action( 'template_redirect', 'dynamic_css_display' );
add_action( 'init','show_bar', 1 );
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
 * Add default posts and comments RSS feed links to head
 */
add_theme_support( 'automatic-feed-links' );

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
		'name' => __( 'Sidebar', 'justcss' ),
		'id' => 'sidebar',
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
global $is_gecko, $is_chrome, $is_safari, $is_IE;
wp_enqueue_style( 'html5reset', get_template_directory_uri() . '/css/html5reset.css', false, JCSS_VERSION );
wp_enqueue_style( 'justcss', get_template_directory_uri() . '/css/justcss.css', false, JCSS_VERSION );
wp_register_style( 'justcss-firefox', get_template_directory_uri() . '/css/firefox.css', false, JCSS_VERSION );
wp_register_style( 'justcss-ie', get_template_directory_uri() . '/css/ie.css', false, JCSS_VERSION );

if ( $is_gecko || $is_chrome || $is_safari ) wp_enqueue_style( 'justcss-firefox' );

if ( $is_IE ) add_action( 'wp_head', 'ie_stuff' );

if ( get_option( 'permalink_structure' ) != '' ) {
wp_enqueue_style( 'user_css', home_url() . '/custom.css/', false, null );
wp_enqueue_style( 'justcss-ie' );
} else {
wp_enqueue_style( 'user_css', home_url() . '/?css=custom', false, JCSS_VERSION );
}
if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' );
}

function ie_stuff() {
wp_enqueue_style( 'justcss-ie' );
echo '<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />';
echo "\r\n" . '<!--[if lt IE 9]>';
echo "\r\n" . '<script src="' . get_template_directory_uri() . '/html5.js" type="text/javascript"></script>';
echo "\r\n" . '<![endif]-->';
}

function flushRules() {
	global $wp_rewrite;
   	$wp_rewrite->flush_rules();
}
// Adding a new rule
function wp_insertMyRewriteRules( $rules ) {
	$newrules = array();
	$newrules[ '^custom\.css' ] = '/?css=custom';
	return $newrules + $rules;
}
// Adding the id var so that WP recognizes it
function wp_insertMyRewriteQueryVars( $vars ) {
    array_push( $vars, 'id' );
    return $vars;
}

function add_new_var_to_wp( $public_query_vars ) {
		array_push( $public_query_vars, 'css' );
		return $public_query_vars;
}
function dynamic_css_display() {
		$css = get_query_var( 'css' );
		if ( $css == 'custom' ){
			include_once( TEMPLATEPATH . '/css/style.php' );
			exit;
		}
}
function show_bar() {
if ( isset( $_REQUEST[ 'nobar' ] ) && $_REQUEST[ 'nobar' ] == 'yes' ) {
	define( 'IFRAME_REQUEST', true );
	  }
}

function jcss_aside() {
  	?><article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
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
<?php }

function jcss_gallery() {
  	?><article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'justcss' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
			<div class="entry-meta">
				<?php
					printf( __( '<span class="meta-prep meta-prep-author">Posted on </span><a href="%1$s" rel="bookmark"><time class="entry-date" datetime="%2$s" pubdate>%3$s</time></a> <span class="meta-sep"> by </span> <span class="author vcard"><a class="url fn n" href="%4$s" title="%5$s">%6$s</a></span>', 'justcss' ),
						get_permalink(),
						get_the_date( 'c' ),
						get_the_date(),
						get_author_posts_url( get_the_author_meta( 'ID' ) ),
						sprintf( esc_attr__( 'View all posts by %s', 'justcss' ), get_the_author() ),
						get_the_author()
					);
				?>
			</div><!-- .entry-meta -->
		</header><!-- .entry-header -->
<?php
$attachments = get_children( array('post_parent' => get_the_ID(), 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'rand') );
$attachment = array_rand( $attachments, 1);
echo '<div style="float:left;padding:5px 15px 5px 5px">' . wp_get_attachment_image($attachment, $size = 'thumbnail', false) . '</div>';
?>
		<div class="entry-summary">
			<?php the_excerpt( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'justcss' ) ); ?>
		</div><!-- .entry-summary -->
<?php //echo do_shortcode('[pf_gallery orderby="rand" limit="1"]') ?>

		<footer class="entry-meta">
			<span class="cat-links"><span class="entry-utility-prep entry-utility-prep-cat-links"><?php _e( 'Posted in ', 'justcss' ); ?></span><?php the_category( ', ' ); ?></span>
			<span class="meta-sep"> | </span>
			<?php the_tags( '<span class="tag-links">' . __( 'Tagged ', 'justcss' ) . '</span>', ', ', '<span class="meta-sep"> | </span>' ); ?>
			<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'justcss' ), __( '1 Comment', 'justcss' ), __( '% Comments', 'justcss' ) ); ?></span>
			<?php edit_post_link( __( 'Edit', 'justcss' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
		</footer><!-- #entry-meta -->
	</article><!-- #post-<?php the_ID(); ?> -->
<?php }