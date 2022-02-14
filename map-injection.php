<?php 
/*
Plugin Name: Map Injection
Plugin URI: https://github/bopdidus/map-injection
Description: This plugin allows you to inject a map in your website without any API Key.
Version: 1.0
License: Didus
Author: BOPDA Brice
Author URI: https://github/bopdidus/

*/


/*  if we don't have access to wordpress directly 
and if the we can access directly to the plugin, then exit */

if(!defined ('ABSPATH')){
    exit;
}


//create a setting menu

//add_action('admin_menu', 'my_menu');

function my_menu(){
    //create new menu
    //Map Injection Setting:  title of my setting
    //map-injection settings : name of the menu
    //administrator: role admin
    // my_menu_plugin_page: where the field will define
   // add_menu_page('Map Injection Setting', 'map-injection settings', 'administrator', __FILE__, 'my_menu_plugin_page');

    //call register settings function
	add_action( 'admin_init', 'register_my_menu_plugin_settings' );
}

function register_my_menu_plugin_settings() {
	//register our settings
	register_setting( 'my-plugin-settings-group', 'location' ); // location_field
	register_setting( 'my-plugin-settings-group', 'width' );// width field
	register_setting( 'my-plugin-settings-group', 'height' ); // height  field
}

function my_menu_plugin_page(){
    ?>
    <div class="wrap">
        <h1>Map Injection</h1>

        <form method="post" name="form_injection">
            <?php settings_fields( 'my-plugin-settings-group' ); ?>
            <?php do_settings_sections( 'my-plugin-settings-group' ); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Location</th>
                    <td><input type="text" name="location" value="<?php echo esc_attr( get_option('location') ); ?>" /></td>
                </tr>
            
                <tr valign="top">
                    <th scope="row">Width</th>
                    <td><input type="number" name="width" value="<?php echo esc_attr( get_option('width') ); ?>" /></td>
                </tr>
            
                <tr valign="top">
                    <th scope="row">Height</th>
                    <td><input type="number" name="height" value="<?php echo esc_attr( get_option('height') ); ?>" /></td>
                </tr>
            </table>
    
            <input type="button" value="Save" onclick="submit_form()" />

        </form>
    </div>

<?php }
/*
function init_shortcode(){
    if(isset($_POST)){
        //extract($_POST);
        var_dump($_POST);
        
        return create_map($_POST['location'], $_POST['width'], $_POST['height']);
    }
}
*/
function create_map($atts){

    $data = shortcode_atts(array(
        'location' => 'douala',
        'width' => '600',
        'height' => '400'
    ), $atts);

    return '<iframe
                width="'.$data['width'].'"
                height="'.$data['height'].'"
                frameborder="0" style="border:0"
                src="https://maps.google.com/maps?q='.$data['location'].'&z=10&output=embed">
            </iframe>';
}

//add_filter('hook-inject', 'create_map', 10,3);
add_shortcode('map-injection', 'create_map');
/*function create_shortcodes(){
    add_shortcode('map-injection', 'create_map');
 }

 add_action( 'init', 'create_shortcodes');*/

?>


