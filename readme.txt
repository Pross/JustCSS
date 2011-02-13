=== JustCSS ===
Tested up to: 3.1
Contributers: Pross
Tags: translation-ready, microformats, rtl-language-support, two-columns, flexible-width, threaded-comments, theme-options, custom-menu, sticky-post, custom-background, custom-colors, custom-menu, editor-style

== Description ==
Pure HTML5 theme with custom colours using css3. This theme is child-theme ready and supports WordPress 3.1, including support for aside and gallery post-formats.

== Notes ==
= The following actions/filters are included =
These filters are to be used in your child theme `functions.php`

= cpanel.php
* `justcss_google_fonts` filter ( see `functions.php` for example )

= header.php =
* `justcss_header_before_nav` action
* `justcss_header_after_nav` action

= footer.php filter =
* `justcss_footer_filter` filter ( see `functions.php` for example )

= page.php =
* `justcss_page_before_content` action
* `justcss_page_after_content` action

= single.php =
* `justcss_single_before_content` action
* `justcss_single_after_content` action

= loop.php =
* `justcss_loop_start` action
* `justcss_loop_start` action


== Changelog ==

= 1.1 =
* Added automatic header image ( if image img/logo.jpg is located )

= 1.0.9 =
* Document functions.
* Use load_template instead of require.

= 1.0.8 =
* rename all functions/options justcss not jcss.
* reorder admin section.

= 1.0.7 =
* Added google fonts API
* `justcss_google_fonts` filter added with example in functions.php.

= 1.0.6 = 
* More css fixes
* Validate HTML5

= 1.0.5 =
* Clean up code fix aside.

= 1.0.4 =
* Fix validation in cpanel.php.

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
* Hook `justcss_header_before_nav` added.
* Hook `justcss_header_after_nav` added.
* Hook `justcss_loop_start` added.
* Hook `justcss_loop_end` added.
* Hook `justcss_page_before_content` added.
* Hook `justcss_page_after_content` added.
* Updated jscolor.

= 0.7 =
* Started adding filters prefixed user.
* Filter `justcss_footer_filter` added.
* Hook `justcss_single_before_content` added to single.php.
* Hook `justcss_single_after_content` added to single.php.
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
