<?php
/* 
Plugin name: WordPress plugin for GIT (Golfens IT system)
Description: A plugin for using the GIT API (Golfens IT API). 
Version: 0.5 
Author: Concil 
URI: https://concil.se 
Author URI: https://concil.se 
*/ 



// Call git_menu function to load plugin menu in dashboard 
add_action( 'admin_menu', 'git_menu' );  
// Create WordPress admin menu 
if( !function_exists("git_menu") ) { 
    function git_menu(){    
        $page_title = 'Inställningar för GIT';   
        $menu_title = 'GIT Inställningar';   
        $capability = 'manage_options';   
        $menu_slug  = 'git-installningar';   
        $function   = 'git_admin_page';   
        $icon_url   = 'dashicons-hammer';   
        $position   = 100;    
        add_menu_page( 
            $page_title,                  
            $menu_title,                  
            $capability,                  
            $menu_slug,                  
            $function,                  
            $icon_url,                  
            $position 
        );    
        // Call register_git_settings function to update database   
        add_action( 'admin_init', 'register_git_settings' );  
    } 
}  
// Create function to register plugin settings in the database 
if( !function_exists("register_git_settings") ) { 
    function register_git_settings() {   
        register_setting( 'git-settings', 'git_guid' ); 
        register_setting( 'git-settings', 'git_username' ); 
        register_setting( 'git-settings', 'git_password' );
        register_setting( 'git-settings', 'git_installed_page' );
        register_setting( 'git-settings', 'git_restricted_pages' );
        register_setting( 'git-settings', 'git_card_background_color');
        register_setting( 'git-settings', 'git_text_color');
        register_setting( 'git-settings', 'git_label_color');
        register_setting( 'git-settings', 'git_link_color');
        register_setting( 'git-settings', 'git_link_hover_color');
        register_setting( 'git-settings', 'git_loading_icon_color');
        register_setting( 'git-settings', 'git_border_color');
        register_setting( 'git-settings', 'git_border_top_color');
        register_setting( 'git-settings', 'git_active_medlemsmatrikel');
        register_setting( 'git-settings', 'git_login_button_color');
        register_setting( 'git-settings', 'git_login_button_text_color');
        register_setting( 'git-settings', 'git_login_label_color');
        register_setting( 'git-settings', 'git_login_heading_color');
        register_setting( 'git-settings', 'git_login_input_border_color');
        register_setting( 'git-settings', 'git_login_input_border_active_color');

    } 
}  
// Create WordPress plugin page 
if( !function_exists("git_admin_page") ) { 
    function git_admin_page(){       
        if (isset($_POST["git_restricted_pages"]) || isset($_GET["git_restricted_pages"])) {
            echo "TEST";
        }
        ?>   
        <h1>GIT Inställningar</h1>   
        <form method="post" action="options.php">     
            <?php settings_fields( 'git-settings' ); ?>     
            <?php do_settings_sections( 'git-settings' ); ?>     
            <table class="form-table">       
                <tr valign="top">       
                    <th scope="row">KlubbID (GUID):</th>       
                    <td><input type="text" name="git_guid" value="<?php echo get_option('git_guid'); ?>"/></td>       
                </tr>     
                <tr valign="top">       
                    <th scope="row">Användarnamn:</th>       
                    <td><input type="text" name="git_username" value="<?php echo get_option('git_username'); ?>"/></td>       
                </tr>     
                <tr valign="top">       
                    <th scope="row">Lösenord:</th>       
                    <td><input type="text" name="git_password" value="<?php echo get_option('git_password'); ?>"/></td>       
                </tr>
                <tr valign="top">       
                    <th scope="row">Sida som har Shortcoden från GIT:</th>       
                    <td><?= get_page(get_option('git_installed_page'))->post_title ?></td>      
                </tr>     
                <tr valign="top">       
                    <th scope="row">Ändra sida som har shortcoden:</th>       
                    <td>
                    <?php wp_dropdown_pages( array(
                        'name'          => 'git_installed_page',
                        'child_of'      => 0,
                        'sort_order'    => 'ASC',
                        'sort_column'   => 'post_title',
                        'hierarchical'  => 1,
                        'post_type'     => 'page',
                        'selected'      => get_option('git_installed_page')
                    ) ); ?>
                    </td> 
                </tr>  
                <tr valign="top">       
                    <th scope="row">Sidor som kräver GIT inloggning:</th>       
                    <td><?= get_page(get_option('git_restricted_pages'))->post_title ?></td>      
                </tr>     
                <tr valign="top">       
                    <th scope="row">Ändra sida som kräver GIT inloggning:</th>       
                    <td>
                    <?php wp_dropdown_pages( array(
                        'name'          => 'git_restricted_pages',
                        'show_option_none' => 'Välj en sida',
                        'child_of'      => 0,
                        'sort_order'    => 'ASC',
                        'sort_column'   => 'post_title',
                        'hierarchical'  => 1,
                        'post_type'     => 'page',
                        'selected'      => get_option('git_restricted_pages')
                    ) ); ?>
                    </td> 
                </tr>
                <tr>
                    <th>
                        <h2>Moduler</h2>
                        <td></td>
                    </th>
                </tr>
                <tr valign="top">       
                    <th scope="row">Medlemsmatrikel:</th>       
                    <td><input type="checkbox" name="git_active_medlemsmatrikel" value="1"<?php checked(1, get_option('git_active_medlemsmatrikel', "1")) ?>/></td>       
                </tr>
                <tr>
                    <th>
                        <h2>Färger</h2>
                        <td></td>
                    </th>
                </tr>
                <tr>
                    <th>
                        <h4>Medlemsmatrikel</h4>
                        <td></td>
                    </th>
                </tr>
                <tr valign="top">       
                    <th scope="row">Bakgrundsfärg kort:</th>       
                    <td><input type="color" name="git_card_background_color" value="<?php echo get_option('git_card_background_color', "#fefefe"); ?>" /></td>       
                </tr>     
                <tr valign="top">       
                    <th scope="row">Textfärg:</th>       
                    <td><input type="color" name="git_text_color" value="<?php echo get_option('git_text_color', "#333333"); ?>" /></td>       
                </tr>     
                <tr valign="top">       
                    <th scope="row">Ettikett-färg:</th>       
                    <td><input type="color" name="git_label_color" value="<?php echo get_option('git_label_color', "#004987"); ?>" /></td>       
                </tr>     
                <tr valign="top">       
                    <th scope="row">Färg Länk:</th>       
                    <td><input type="color" name="git_link_color" value="<?php echo get_option('git_link_color', "#004987"); ?>" /></td>       
                </tr>     
                <tr valign="top">       
                    <th scope="row">Färg Aktiv Länk:</th>       
                    <td><input type="color" name="git_link_hover_color" value="<?php echo get_option('git_link_hover_color', "#004987"); ?>" /></td>       
                </tr>     
                <tr valign="top">       
                    <th scope="row">Färg Laddningsikon:</th>       
                    <td><input type="color" name="git_loading_icon_color" value="<?php echo get_option('git_loading_icon_color', "#004987"); ?>" /></td>       
                </tr>     
                <tr valign="top">       
                    <th scope="row">Ramfärg:</th>       
                    <td><input type="color" name="git_border_color" value="<?php echo get_option('git_border_color', "#eeeeee"); ?>" /></td>       
                </tr>     
                <tr valign="top">       
                    <th scope="row">Ramfärg top:</th>       
                    <td><input type="color" name="git_border_top_color" value="<?php echo get_option('git_border_top_color', "#004987"); ?>" /></td>       
                </tr>     
                <tr>
                    <th>
                        <h4>Login</h4>
                        <td></td>
                    </th>
                </tr>
                <tr valign="top">       
                    <th scope="row">Färg Login knapp:</th>       
                    <td><input type="color" name="git_login_button_color" value="<?php echo get_option('git_login_button_color', "#004987"); ?>" /></td>       
                </tr>  
                <tr valign="top">       
                    <th scope="row">Färg Text Login knapp:</th>       
                    <td><input type="color" name="git_login_button_text_color" value="<?php echo get_option('git_login_button_text_color', "#ffffff"); ?>" /></td>       
                </tr>  
                <tr valign="top">       
                    <th scope="row">Färg Rubrik:</th>       
                    <td><input type="color" name="git_login_heading_color" value="<?php echo get_option('git_login_heading_color', "#004987"); ?>" /></td>       
                </tr>  
                <tr valign="top">       
                    <th scope="row">Färg Ettiketttext:</th>       
                    <td><input type="color" name="git_login_label_color" value="<?php echo get_option('git_login_label_color', "#004987"); ?>" /></td>       
                </tr>  
                <tr valign="top">       
                    <th scope="row">Färg textfält Ram:</th>       
                    <td><input type="color" name="git_login_input_border_color" value="<?php echo get_option('git_login_input_border_color', "#004987"); ?>" /></td>       
                </tr>  
                <tr valign="top">       
                    <th scope="row">Färg textfält Ram Aktiv:</th>       
                    <td><input type="color" name="git_login_input_border_active_color" value="<?php echo get_option('git_login_input_border_active_color', "#1472c5"); ?>" /></td>       
                </tr>           
            </table>   
            <?php submit_button(null, "primary", "test"); ?>   
        </form> <?php 
    } 
}


// The shortcode function
function wpb_demo_shortcode_2() { 
    if( is_admin() )
    return;
 
    wp_enqueue_script( 'my-vue-app-vendors',
        plugins_url( '/app/build/js/chunk-vendors.js', __FILE__ ),
        array(),
        '1.0.0'
    );
    wp_enqueue_script( 'my-vue-app',
        plugins_url( '/app/build/app.js', __FILE__ ),
        array( 'my-vue-app-vendors' ),
        '1.0.0'
    );
    wp_enqueue_style( 'my-vue-app',
        plugins_url( '/app/build/app.css', __FILE__),
        array(),
        '1.0.0'
    );

    global $post;

    $data = array(
        // get whatever data here
        'git_guid' => get_option("git_guid"),
        'git_username' => get_option("git_username"),
        'git_password' => get_option("git_password"),
        'app_path' => $post->post_name,
        'git_card_background_color' => get_option('git_card_background_color', "#fefefe"),
        'git_text_color' => get_option('git_text_color', "#333333"),
        'git_label_color' => get_option('git_label_color', "#004987"),
        'git_link_color' => get_option('git_link_color', "#004987"),
        'git_link_hover_color' => get_option('git_link_hover_color', "#004987"),
        'git_loading_icon_color' => get_option('git_loading_icon_color', "#004987"),
        'git_border_color' => get_option('git_border_color', "#eeeeee"),
        'git_border_top_color' => get_option('git_border_top_color', "#004987"),
        'git_active_medlemsmatrikel' => get_option('git_active_medlemsmatrikel', "1"),
        'git_login_button_color' => get_option('git_login_button_color', "#004987"),
        'git_login_button_text_color' => get_option('git_login_button_text_color', "#ffffff"),
        'git_login_heading_color' => get_option('git_login_heading_color', "#004987"),
        'git_login_label_color' => get_option('git_login_label_color', "#004987"),
        'git_login_input_border_color' => get_option('git_login_input_border_color', "#004987"),
        'git_login_input_border_active_color' => get_option('git_login_input_border_active_color', "#1472c5"),
      );

    wp_localize_script('my-vue-app', 'vueData', $data );

    return '<div id="app"></div>';     
}
// Register shortcode
add_shortcode('git_code', 'wpb_demo_shortcode_2'); 



// ###########################################
// **
// Checks for cookie "concil-git-valid", redirects to /test if the page name/slug is "private"
// *

function cookiebasedredirect() {
    // Checks that the cookie "concil-git-valid" is not set
    if ( !isset($_COOKIE["concil-git-valid"])) {
        // GRABS THE CURRENT PAGE NAME - THIS IS ALSO KNOWS AS THE PAGE/POST SLUG
        $pagename = get_query_var('pagename');
		// Redirects if the slug of the page is "private"
        if( $pagename == get_page(get_option('git_restricted_pages'))->post_name) {          
            wp_redirect( get_site_url(). '/' . get_page(get_option('git_installed_page'))->post_name ); exit;
        } else {
			// The page name/slug is not correct, Return.
			return;
		}
    } else {
		// Cookie is not set, Return
		return;
	}
}
add_action("template_redirect", "cookiebasedredirect");

##############################################


?>