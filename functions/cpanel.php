<?php
add_action('admin_init', 'jcss_options_init_fn' );
add_action('admin_menu', 'jcss_options_add_page_fn');
add_action('init', 'add_defaults_fn');
function jcss_options_init_fn(){
	wp_register_script( 'jscolor', get_template_directory_uri() . '/functions/jscolor/jscolor.js' );
	wp_enqueue_script( 'jscolor' );
	register_setting('jcss_options', 'jcss_options', 'jcss_options_validate' );
	add_settings_section('main_section', 'Main Settings', 'section_text_fn', __FILE__);
	add_settings_field('main_font', 'Google Font', 'setting_font_dropdown_fn', __FILE__, 'main_section');
	add_settings_field('jcss_nav', 'Navbar Colour', 'setting_nav_fn', __FILE__, 'main_section');
	add_settings_field('jcss_nav_col', 'Select menu color scheme', 'setting_nav_dropdown_fn', __FILE__, 'main_section');
	add_settings_field('jcss_widget', 'Widget Colour', 'setting_widget_fn', __FILE__, 'main_section');
	add_settings_field('jcss_sticky', 'Sticky Colour', 'setting_sticky_fn', __FILE__, 'main_section');
	add_settings_field('jcss_bpo_radio', 'Enable bypostauthor css', 'setting_bpo_enable_fn', __FILE__, 'main_section');
	add_settings_field('jcss_bypostauthor', 'Colour for .bypostauthor', 'setting_bypostauthor_fn', __FILE__, 'main_section');
	add_settings_field('jcss_comment_even', 'Comments even', 'setting_comment_even_fn', __FILE__, 'main_section');
	add_settings_field('jcss_comment_odd', 'Comments odd', 'setting_comment_odd_fn', __FILE__, 'main_section');
	add_settings_field('jcss_aside', 'Aside Colour', 'setting_aside_fn', __FILE__, 'main_section');
	add_settings_field('jcss_corners', 'Corner radius', 'setting_corner_fn', __FILE__, 'main_section');
	add_settings_field('jcss_brackets', 'Enable {} around blog title', 'setting_brackets_fn', __FILE__, 'main_section');
	add_settings_field('jcss_mainfont', 'Primary font colour', 'setting_mainfont_fn', __FILE__, 'main_section');
	add_settings_field('jcss_width', 'Theme width px', 'setting_width_fn', __FILE__, 'main_section');
	add_settings_field('jcss_reset', 'Restore Defaults?', 'setting_reset_fn', __FILE__, 'main_section');
}

// Add sub page to the Settings Menu
function jcss_options_add_page_fn() {
	add_theme_page( 'JustCSS Options', 'JustCSS Options', 'edit_theme_options', basename( __FILE__ ), 'options_page_fn' );
}

// Display the admin options page
function options_page_fn() {
?>
	<div class="wrap">
		<div class="icon32" id="icon-options-general"><br></div>
		<h2>JustCSS Options Page</h2>
		<form action="options.php" method="post">
		<?php settings_fields('jcss_options'); ?>
		<?php do_settings_sections(__FILE__); ?>
		<p class="submit">
			<input name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
		</p>
		</form>
	</div>
<?php
}

// Validate user data for some/all of your input fields
function jcss_options_validate($input) {
	$input['corner'] = ( (int) $input['corner'] && $input['corner'] > 0 && $input['corner'] < 25 ) ? $input['corner'] : 8;
	$input['width'] = ( (int) $input['width'] && $input['width'] > 720 && $input['width'] < 2000 ) ? $input['width'] : 1024;
	$input['nav'] = ( preg_match( '/^#?([a-f]|[A-F]|[0-9]){3}(([a-f]|[A-F]|[0-9]){3})?$/', $input['nav'], $out ) ) ? $out[0] : 'eee';
	$input['widget'] = ( preg_match( '/^#?([a-f]|[A-F]|[0-9]){3}(([a-f]|[A-F]|[0-9]){3})?$/', $input['widget'], $out ) ) ? $out[0] : 'eee';
	$input['sticky'] = ( preg_match( '/^#?([a-f]|[A-F]|[0-9]){3}(([a-f]|[A-F]|[0-9]){3})?$/', $input['sticky'], $out ) ) ? $out[0] : 'eee';
	$input['bypostauthor'] = ( preg_match( '/^#?([a-f]|[A-F]|[0-9]){3}(([a-f]|[A-F]|[0-9]){3})?$/', $input['bypostauthor'], $out ) ) ? $out[0] : 'eee';
	$input['odd'] = ( preg_match( '/^#?([a-f]|[A-F]|[0-9]){3}(([a-f]|[A-F]|[0-9]){3})?$/', $input['odd'], $out ) ) ? $out[0] : 'fcfcfc';
	$input['even'] = ( preg_match( '/^#?([a-f]|[A-F]|[0-9]){3}(([a-f]|[A-F]|[0-9]){3})?$/', $input['even'], $out ) ) ? $out[0] : 'eee';
	$input['aside'] = ( preg_match( '/^#?([a-f]|[A-F]|[0-9]){3}(([a-f]|[A-F]|[0-9]){3})?$/', $input['aside'], $out ) ) ? $out[0] : 'f2f2f2';
	$input['mainfont'] = ( preg_match( '/^#?([a-f]|[A-F]|[0-9]){3}(([a-f]|[A-F]|[0-9]){3})?$/', $input['mainfont'], $out ) ) ? $out[0] : '000';
	return $input; // return validated input
}
// ************************************************************************************************************

// Callback functions

function  section_text_fn() {
//	echo '<p>The main JustCSS options.</p>';
}

function setting_nav_fn() {
	$options = get_option('jcss_options');
	echo "<input class='color {hash:false}' id='jcss_nav' name='jcss_options[nav]' size='40' type='text' value='{$options['nav']}' />";
}

function  setting_nav_dropdown_fn() {
	$options = get_option('jcss_options');
	$items = array("JustCSS", "Toolbox");
	echo "<select id='nav_col' name='jcss_options[nav_col]'>";
	foreach($items as $item) {
		$selected = ($options['nav_col']==$item) ? 'selected="selected"' : '';
		echo "<option value='$item' $selected>$item</option>";
	}
	echo "</select>";
}

function  setting_font_dropdown_fn() {
	$options = get_option('jcss_options');
	$items = array("Molengo", "Cantarell", "Arimo", "puritan", "Crimson Text", "Droid Sans");
	echo "<select id='main_font' name='jcss_options[main_font]'>";
	foreach( $items as $item ) {
		$selected = ($options['main_font']==$item) ? 'selected="selected"' : '';
		echo "<option value='$item' $selected>$item</option>";
	}
	echo "</select>";
}






function setting_widget_fn() {
	$options = get_option('jcss_options');
	echo "<input class='color {hash:false}' name='jcss_options[widget]' size='40' type='text' value='{$options['widget']}' />";
}

function setting_sticky_fn() {
	$options = get_option('jcss_options');
	echo "<input class='color {hash:false}' name='jcss_options[sticky]' size='40' type='text' value='{$options['sticky']}' />";
}

function setting_bpo_enable_fn() {
	$options = get_option('jcss_options');
	$items = array("Yes", "No");
	foreach($items as $item) {
		$checked = ($options['bpo']==$item) ? ' checked="checked" ' : '';
		echo "<label><input ".$checked." value='$item' name='jcss_options[bpo]' type='radio' /> $item</label><br />";
	}
}

function setting_bypostauthor_fn() {
	$options = get_option('jcss_options');
	echo "<input class='color {hash:false}' name='jcss_options[bypostauthor]' size='40' type='text' value='{$options['bypostauthor']}' />";
}

function setting_comment_even_fn() {
	$options = get_option('jcss_options');
	echo "<input class='color {hash:false}' name='jcss_options[even]' size='40' type='text' value='{$options['even']}' />";
}

function setting_comment_odd_fn() {
	$options = get_option('jcss_options');
	echo "<input class='color {hash:false}' name='jcss_options[odd]' size='40' type='text' value='{$options['odd']}' />";
}

function setting_aside_fn() {
	$options = get_option('jcss_options');
	echo "<input class='color {hash:false}' name='jcss_options[aside]' size='40' type='text' value='{$options['aside']}' />";
}

function setting_corner_fn() {
	$options = get_option('jcss_options');
	echo "<input id='jcss_corner' name='jcss_options[corner]' size='4' type='text' value='{$options['corner']}' />";
}

function setting_brackets_fn() {
	$options = get_option('jcss_options');
	$items = array("Yes", "No");
	foreach($items as $item) {
		$checked = ($options['brackets']==$item) ? ' checked="checked" ' : '';
		echo "<label><input ".$checked." value='$item' name='jcss_options[brackets]' type='radio' /> $item</label><br />";
	}
}

function setting_mainfont_fn() {
	$options = get_option('jcss_options');
	echo "<input class='color {hash:false}' name='jcss_options[mainfont]' size='40' type='text' value='{$options['mainfont']}' />";
}

function setting_width_fn() {
	$options = get_option('jcss_options');
	echo "<input id='jcss_width' name='jcss_options[width]' size='4' type='text' value='{$options['width']}' />";
}

function setting_reset_fn() {
	$options = get_option('jcss_options');
	$checked = ( isset( $options['reset']) ) ? ' checked="checked" ' : '';


//	if( isset( $options['reset']) ) { $checked = ' checked="checked" '; }
	echo "<input ".$checked." id='reset' name='jcss_options[reset]' type='checkbox' />";
}

function add_defaults_fn() {
	$tmp = get_option('jcss_options');
	if ( ( isset( $tmp['reset'] ) && $tmp['reset'] == 'on' ) || ( !is_array( $tmp ) ) ) {
		$arr = array("nav"=>"eee", "nav_col" => "JustCSS", "widget" => "eee", "sticky" => "eee", "bpo" => "No", "bypostauthor" => "eee", "even" => "eee", 'odd' => 'fcfcfc', 'aside' => 'f2f2f2', 'corner' => '8', 'brackets' => 'Yes', 'mainfont' => '000', 'width' => '1024', 'main_font' => 'Canterell');
		update_option('jcss_options', $arr);
	}
}