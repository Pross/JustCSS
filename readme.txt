=== JustCSS ===
Tested up to: 3.1
Contributers: Pross
Tags: translation-ready, microformats, rtl-language-support, two-columns, flexible-width, threaded-comments, theme-options, custom-menu, sticky-post, custom-background, custom-colors, custom-menu, editor-style 

== Description ==
Pure HTML5 theme with custom colours using css3 originally based on Toolbox. Includes support for aside and gallery post-formats.

== Notes ==
= The following actions/filters are included =
These filters are to be used in your child theme `functions.php`
= header.php =
* `jcss_header_before_nav` action
* `jcss_header_after_nav` action

= footer.php filter =
* `jcss_footer_filter` filter ( see `functions.php` for example )

= page.php =
* `jcss_page_before_content` action
* `jcss_page_after_content` action

= single.php =
* `jcss_single_before_content` action
* `jcss_single_after_content` action

= loop.php =
* `jcss_loop_start` action
* `jcss_loop_start` action


== Changelog ==

= 1.0.3 =
* live.

= 1.0.2 =
* Fixed admin bug.

= 1.0 = 
* Moved to settings API with full dtat validation with regex.
* Removed dynamic css file style.php ( css added to head now to save requests to db ).
* Added support for post-formats ( aside, gallery ).
* format galley has random image shown on index.
* included PIE to render CSS3 in IE < 9.

= 0.9 =
* Released.

= 0.8 =
* Merged toolbox into theme.
* Added example filter in `functions.php`.
* Hook `jcss_header_before_nav` added.
* Hook `jcss_header_after_nav` added.
* Hook `jcss_loop_start` added.
* Hook `jcss_loop_end` added.
* Hook `jcss_page_before_content` added.
* Hook `jcss_page_after_content` added.
* Updated jscolor.

= 0.7 =
* Started adding filters prefixed user.
* Filter `jcss_footer_filter` added.
* Hook `jcss_single_before_content` added to single.php.
* Hook `jcss_single_after_content` added to single.php.
* Added main fonts to `style.php` and added user selection in cp.
= 0.6 =
* Tested and released.
= 0.5 =
* Split out browser css and load depending on users browser.
* Added option to remove {} from blogname.
* Added theme width option.
* Removed wp_footer call.
	
= 0.4 =
* First release into WordPress Themes Directory.