<?php
/*Start of Theme Options*/

$justcss = 'JustCSS';
$shortname = 'jcss';
$options = array (
    array(  'name' => 'Navbar colour',
	    'desc' => 'Custom navbarcolours',
            'id' => $shortname.'_nav',
            'std' => '#eee',
            'type' => 'text',
	    'class' => 'color {hash:true}'
	),

    array(  'name' => 'Widget colour',
	    'desc' => 'Custom widget colours',
            'id' => $shortname.'_widget',
            'std' => '#eee',
            'type' => 'text',
	    'class' => 'color {hash:true}'
	),

    array(  'name' => 'Sticky colour',
	    'desc' => 'Custom sticky post colour',
            'id' => $shortname.'_sticky',
            'std' => '#eee',
            'type' => 'text',
	    'class' => 'color {hash:true}'
	),
    array(  'name' => 'Enable .bypostauthor',
	    'desc' => '',
            'id' => $shortname.'_bpo',
            'std' => 'No',
            'type' => 'radio',
	    'options' => array('Yes', 'No')
	),
    array(  'name' => '.bypostauthor colour',
	    'desc' => 'Custom background colour',
            'id' => $shortname.'_bypostauthor',
            'std' => '#eee',
            'type' => 'text',
	    'class' => 'color {hash:true}'
	),

    array(  'name' => 'Comment colour #1',
	    'desc' => 'Custom comment colours',
            'id' => $shortname.'_even',
            'std' => '#eee',
            'type' => 'text',
	    'class' => 'color {hash:true}'
	),

    array(  'name' => 'Comment colour #2',
	    'desc' => 'Custom comment colours',
            'id' => $shortname.'_odd',
            'std' => '#fcfcfc',
            'type' => 'text',
	    'class' => 'color {hash:true}'
	),

    array(  'name' => 'Aside background',
	    'desc' => 'Custom aside background',
            'id' => $shortname.'_aside',
            'std' => '#f2f2f2',
            'type' => 'text',
	    'class' => 'color {hash:true}'
	),

    array(  'name' => 'CSS3 Corners',
	    'desc' => 'Corner size',
            'id' => $shortname.'_corner',
            'std' => '8',
            'type' => 'text',
	),

    array(  'name' => 'Show {} around blogname.',
	    'desc' => 'removes the brackets',
            'id' => $shortname.'_brackets',
            'std' => 'Yes',
            'type' => 'radio',
	    'options' => array('Yes', 'No')
	),

    array(  'name' => 'Font',
            'desc' => 'Primary text colour',
            'id' => $shortname.'_mainfont',
            'std' => '#000000',
            'type' => 'text',
            'class' => 'color {hash:true}'
        ),

    array(  'name' => 'Theme Width',
	    'desc' => 'Overall theme width',
            'id' => $shortname.'_width',
            'std' => '1024',
            'type' => 'text',
	   // 'class' => 'color {hash:true}'
	)						//The last option should not have a comma after the closing ) bracket
);

function mytheme_add_options() {
global $justcss, $shortname, $options;
foreach ( $options as $value ) {
	$key = $value[ 'id' ];
	$val = $value[ 'std' ];
		if( $existing = get_option( $key ) ) { 	//This is useful if you've used a previous version that added seperate values to wp_options
			$new_options[ $key ] = $existing; //This will add the value to the array
			delete_option( $key ); 		//This deletes the old entry and cleans up the wp_option table
		} else {
			$new_options[ $key ] = $val;
			delete_option( $key );
		}
}
add_option( $shortname.'_options', $new_options );
}

function first_run_options() {				//This is for theme init
global $shortname;
$check = get_option( $shortname.'_version' );
	if ( $check != JCSS_VERSION ) {
		mytheme_add_options();			//This runs the theme init fuction specified eariler
   	//	add_option($shortname.'_activation_check', 'set');	// Add marker so it doesn't run in future
		update_option( $shortname.'_version', JCSS_VERSION );
  	}
}
add_action( 'wp_head', 'first_run_options' );
add_action( 'admin_head', 'first_run_options' );

function mytheme_add_admin() {
	wp_register_script( 'jscolor', get_stylesheet_directory_uri() . '/functions/jscolor/jscolor.js' );
	wp_enqueue_script( 'jscolor' );
	global $justcss, $shortname, $options;
	$settings = get_option( $shortname.'_options' );
	if ( isset( $_GET[ 'page' ] ) && $_GET[ 'page' ] == basename( __FILE__ ) ) {
        if ( isset( $_REQUEST[ 'action' ] ) && 'save' == $_REQUEST[ 'action' ] ) {
		foreach ( $options as $value ) {
			if( ($value[ 'type' ] === 'checkbox' or $value[ 'type' ] === 'multiselect' ) and is_array( $_REQUEST[ $value[ 'id' ] ] ) )
				{ $_REQUEST[ $value[ 'id' ] ] = implode( ',', $_REQUEST[ $value[ 'id' ] ] ); //This will take from the array and make one string
				}
			$key = $value[ 'id' ];
			$val = $_REQUEST[ $key ];
			$settings[ $key ] = $val;
		}
update_option( $shortname.'_options', $settings );
header( 'Location: themes.php?page=cpanel.php&saved=true' );
                die;
        } else if( isset( $_REQUEST[ 'action' ] ) && 'reset' == $_REQUEST[ 'action' ] ) {
		foreach ( $options as $value ) {
			$key = $value[ 'id' ];
			$std = $value[ 'std' ];
			$new_options[ $key ] = $std;
		}
update_option( $shortname.'_options', $new_options );
            header( 'Location: themes.php?page=cpanel.php&reset=true' );
            die;
        }
    }
    add_theme_page( $justcss.' Options', 'JustCSS Options', 'edit_theme_options', basename( __FILE__ ), 'mytheme_admin' );

}

function mytheme_admin() {
    global $justcss, $shortname, $options;
    if ( isset( $_REQUEST[ 'saved' ] ) ) echo "<div id='message' class='updated fade'><p><strong>$justcss settings saved.</strong></p></div>";
    if ( isset( $_REQUEST[ 'reset' ] ) ) echo "<div id='message' class='updated fade'><p><strong>$justcss settings reset.</strong></p></div>";
?>
<div class='wrap'>
<h2><?php echo $justcss; ?> settings</h2>
<form method='post'>
<table class='optiontable'>
<?php
$settings = get_option( $shortname.'_options' );
foreach ( $options as $value ) {
	$id = $value[ 'id' ];
	$std = $value[ 'std' ];
	if ( $value[ 'type' ] == 'text' ) { ?>
  <tr valign='middle'>
        <th scope='top' style='text-align:left;'><?php echo $value['name']; ?>:</th>
	<?php if( isset( $value[ 'desc' ] ) ) {?>
	</tr>
	<tr valign='middle'>
		<td style='width:40%;'><?php echo $value[ 'desc' ]; ?></td>
	<?php } ?>
        <td>
        <input name='<?php echo $value[ 'id' ]; ?>'<?php if ( isset( $value[ 'class' ] ) ) { echo 'class="' . $value[ 'class' ] . '"'; } ?> id="<?php echo $value[ 'id' ]; ?>" type="<?php echo $value[ 'type' ]; ?>" value="<?php if ( $settings[ $id ] != '' ) { echo $settings[ $id ]; } else { echo $value[ 'std' ]; } ?>" size="40" />
    </td>
</tr>
<tr><td colspan=2><hr /></td></tr>
<?php } elseif ( $value[ 'type' ] == 'select' ) { ?>
<tr valign='middle'>
        <th scope='top' style='text-align:left;'><?php echo $value[ 'name' ]; ?>:</th>
	<?php if( isset( $value[ 'desc' ] ) ) {?>
	</tr>
	<tr valign='middle'>
		<td style='width:40%;'><?php echo $value[ 'desc' ]; ?></td>
	<?php } ?>
        <td>
            <select name='<?php echo $value[ 'id' ]; ?>' id='<?php echo $value[ 'id' ]; ?>'>
                <?php foreach ( $value[ 'options' ] as $option ) { ?>
                <option<?php if ( $settings[ $id ] == $option ) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
                <?php } ?>
            </select>
        </td>
    </tr>
<tr><td colspan=2><hr /></td></tr>
<?php } elseif ( $value[ 'type' ] == 'multiselect' ) { ?>
<tr valign='middle'>
        <th scope='top' style='text-align:left;'><?php echo $value[ 'name' ]; ?>:</th>
	<?php if( isset( $value[ 'desc' ] ) ) {?>
	</tr>
	<tr valign='middle'>
		<td style='width:40%;'><?php echo $value[ 'desc' ]?></td>
	<?php } ?>
        <td>
            <select  multiple='multiple' size='3' name='<?php echo $value[ 'id' ]; ?>[]' id='<?php echo $value[ 'id' ]; ?>' style='height:50px;'>
                <?php $ch_values = explode( ',', $settings[ $id ] ); foreach ( $value[ 'options' ] as $option ) { ?>
                <option<?php if ( in_array( $option, $ch_values ) ) { echo" selected='selected'"; } ?> value='<?php echo $option; ?>'><?php echo $option; ?></option>
                <?php } ?>
            </select>
        </td>
    </tr>
<tr><td colspan=2><hr /></td></tr>

<?php } elseif ( $value[ 'type' ] == 'radio' ) { ?>
<tr valign='middle'>
        <th scope='top' style='text-align:left;'><?php echo $value[ 'name' ]; ?>:</th>
	<?php if( isset( $value[ 'desc' ] ) ) { ?>
	</tr>
	<tr valign='middle'>
		<td style='width:40%;'><?php echo $value[ 'desc' ]; ?></td>
	<?php } ?>
        <td>
		<?php foreach ( $value[ 'options' ] as $option ) { ?>
			<?php echo $option; ?><input name='<?php echo $value[ 'id' ]; ?>' type='<?php echo $value[ 'type' ]; ?>' value='<?php echo $option; ?>' <?php if ( $settings[ $id ] == $option) { echo 'checked'; } ?>/>|
		<?php } ?>
        </td>
    </tr>
<tr><td colspan=2><hr /></td></tr>
<?php } elseif ( $value[ 'type' ] == 'textarea' ) { ?>
<tr valign='middle'>
        <th scope='top' style='text-align:left;'><?php echo $value[ 'name' ]; ?>:</th>
	<?php if( isset( $value[ 'desc' ] ) ) { ?>
	</tr>
	<tr valign='middle'>
		<td style='width:40%;'><?php echo $value[ 'desc' ]; ?></td>
	<?php } ?>
        <td>
            <textarea name='<?php echo $value[ 'id' ]; ?>' id='<?php echo $value[ 'id' ]; ?>' cols='40' rows='5'/><?php if ( $settings[ $id ] != '') { echo $settings[ $id ]; } else { echo $value[ 'std' ]; } ?></textarea>
		</td>
    </tr>
<tr><td colspan=2><hr /></td></tr>

<?php } elseif ( $value[ 'type' ] == 'checkbox' ) { ?>

    <tr valign='middle'>
        <th scope='top' style='text-align:left;'><?php echo $value[ 'name' ]; ?>:</th>
	<?php if( isset( $value[ 'desc' ] ) ) { ?>
	</tr>
	<tr valign='middle'>
		<td style='width:40%;'><?php echo $value[ 'desc' ]?></td>
	<?php } ?>
        <td>
		<?php
		$ch_values = explode( ',', $settings[ $id ] );
		foreach ( $value[ 'options' ] as $option ) {
		echo $option; ?><input name='<?php echo $value[ 'id' ]; ?>[]' type='<?php echo $value[ 'type' ]; ?>' value='<?php echo $option; ?>' <?php if ( in_array( $option, $ch_values ) ) { echo 'checked'; } ?>/>|
<?php 		} ?>

        </td>
    </tr>
<tr><td colspan=2><hr /></td></tr>
<?php }
}//End of foreach loop
?>
</table>
<p class='submit'>
<input name='save' type='submit' value='Save changes' />
<input type='hidden' name='action' value='save' />
</p>
</form>
<form method='post'>
<p class='submit'>
<input name='reset' type='submit' value='Reset' />
<input type='hidden' name='action' value='reset' />
</p>
</form>
<h2>Preview (updated when options are saved)</h2>
<iframe src='../?nobar=yes' width='100%' height='600' ></iframe>
<?php
} 	//End Tag for mytheme_admin()
add_action( 'admin_menu', 'mytheme_add_admin' );